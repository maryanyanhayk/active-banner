<?php

namespace App\Console\Commands;

use App\Article;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GetTertData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'grab:tert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grab data from tert.am';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        libxml_use_internal_errors(true);
        $base_url = 'http://www.tert.am/am/news/';
        $pages_count = 100;

        Article::truncate();
        for ($i = 1; $i <= $pages_count; $i++) {
            $current_url = $base_url . $i;

            $content = $this->exec($current_url);
            if ($content) {
                $dom = new \DOMDocument();
                $dom->loadHTML($content);
                $dom->preserveWhiteSpace = false;

                $finder = new \DOMXPath($dom);
                $classname = "news-blocks";
                $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");


                foreach ($nodes as $node) {
                    $date_time = $node->getElementsByTagName('p')->item(0)->nodeValue;
                    $link = $node->getElementsByTagName('a')->item(0)->getAttribute('href');
                    $title = $node->getElementsByTagName('h4')->item(0)->nodeValue;


                    $time = trim(explode('•', $date_time)[0]);
                    $date = trim(explode('•', $date_time)[1]);
                    $published_date = Carbon::createFromFormat('d.m.y H:i', $date . ' ' . $time)
                        ->format('Y-m-d H:i:s');

                    $final_page = $this->parse_final_page($link);


                    Article::create([
                        'title' => $title,
                        'description' => $final_page['description'],
                        'img_url' => $final_page['image_path'],
                        'published_date' => $published_date
                    ]);
                }
            }
        }

    }


    public function exec($url)
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $content = curl_exec($ch);
        curl_close($ch);

        return $content;

    }

    public function parse_final_page($url)
    {libxml_use_internal_errors(true);
        $content = $this->exec($url);

        $dom = new \DOMDocument();
        $dom->loadHTML($content);
        $dom->preserveWhiteSpace = false;

        $i_content = $dom->getElementById('i-content');

        $description = trim($i_content->getElementsByTagName('p')->item(0)->textContent);
        $image_url = trim($i_content->getElementsByTagName('img')->item(0)->getAttribute('src'));

        $image_path = $this->load_image($image_url);


        return [
            'description' => $description,
            'image_path' => $image_path,
        ];
    }

    public function load_image($image_url)
    {

        $file_name = uniqid();
        $full_path = storage_path('app/public/') . $file_name;

        $ch = curl_init($image_url);
        $fp = fopen($full_path, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        return url('/storage') . '/' . $file_name;
    }
}
