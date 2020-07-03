<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateScheduleSwapModification;
use App\Repositories\ModelRepository\GroupRepository;
use App\Repositories\ModelRepository\ScheduleRepository;
use Debugbar;
use File;
use Illuminate\Http\Request;
use Storage;
use Symfony\Component\DomCrawler\Crawler;

class ParserController extends BaseController
{
    public function swap_schedule_parse()
    {
        $link = 'https://mpt.ru/studentu/izmeneniya-v-raspisanii/';
        $html = file_get_contents($link);

        $crawler = new Crawler(null, $link);
        $crawler->addHtmlContent($html, 'UTF-8');

        $content = $crawler->filter('main > div > div > div')->last()->filterXPath("./div//div//table | ./div//h4");

        $result = [];
        $length = count($content);
        for ($i = 1; $i < $length; $i++) {
            $buffer = [];
            $element = $content->eq($i - 1);
            preg_match("/\b\d{2}\.\d{2}\.\d{4}\b/",$element->text(),$date);
            while ($i != $length && $content->eq($i)->nodeName() != 'h4') {
                $dat = [];
                $group_text = str_replace("Группа: ","",$content->eq($i)->filterXPath("./table/caption")->text());
                $dat['group'] =  $group_text;
                $dat["swap_date"] = $date[0];
                $table = $content->eq($i)->filterXPath("./table/tr[position()>1]")->evaluate("./td//text()");
                $lesson = [];
                for ($j = 0; $j < count($table) / 4; $j++) {
                    $les = $table->eq(2 + 4 * $j)->text();
                    preg_match_all('/[А-яЁ]\.[А-яЁ]\.\s.+,|[А-яЁ]\.[А-яЁ]\.\s.+/u', $les, $teacher);
                    array_push($lesson, [
                        "caselesson" => $table->eq(0 + 4 * $j)->text(),
                        "what" => $table->eq(1 + 4 * $j)->text(),
                        "lesson" => rtrim(preg_replace("/[А-яЁ]\.[А-яЁ]\.\s.+/u", "", $les)),
                        "teacher" => str_replace(",", '', $teacher[0]),
                        "created_at" => $table->eq(3 + 4 * $j)->text(),
                    ]);
                }
                $dat["swap"] = $lesson;
                array_push($buffer, $dat);
                $i++;
            }
            $result[$element->text()] = $buffer;
        }

        return response()->json(compact('result'));
    }

    public function save(Request $request,CreateScheduleSwapModification $createScheduleSwapModification){
        $data = $request->all();
        $result = $createScheduleSwapModification->addParsedScheduleSwapToDatabase($data);
        return response()->json(compact('result'));
    }
}
