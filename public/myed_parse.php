<?php
// myed_parse.php - Core parsing logic ported from Svelte/TypeScript
// Only includes HTML parsing for assignments and attendance as an example

function parse_assignments($html) {
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $rows = $xpath->query('//tr[contains(@class, "listCell")]');
    $assignments = [];
    foreach ($rows as $row) {
        $cells = $row->getElementsByTagName('td');
        if ($cells->length >= 8) {
            $name = trim($cells->item(1)->textContent);
            $due = trim($cells->item(3)->textContent);
            $pct = trim($cells->item(6)->textContent);
            $score = trim($cells->item(7)->textContent);
            $feedback = $cells->length > 9 ? trim($cells->item(9)->textContent) : '';
            // Parse fraction like "16.5 / 18.0" in pct
            if (preg_match('/(\d+(?:\.\d+)?)\s*[\/⁄∕]\s*(\d+(?:\.\d+)?)/', $pct, $m)) {
                $num = floatval($m[1]);
                $den = floatval($m[2]);
                if ($den > 0) {
                    $pct = strval(round(($num / $den) * 100));
                    $score = "$num / $den";
                }
            }
            $assignments[] = [
                'name' => $name,
                'due' => $due,
                'pct' => $pct,
                'score' => $score,
                'feedback' => $feedback
            ];
        }
    }
    return $assignments;
}

function parse_attendance($html) {
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $rows = $xpath->query('//tr[contains(@class, "listCell")]');
    $records = [];
    foreach ($rows as $row) {
        $cells = $row->getElementsByTagName('td');
        if ($cells->length >= 3) {
            $date = trim($cells->item(1)->textContent);
            $code = trim($cells->item(2)->textContent);
            $reason = '';
            for ($i = 3; $i < $cells->length; $i++) {
                $reason .= trim($cells->item($i)->textContent) . ' ';
            }
            $records[] = [
                'date' => $date,
                'code' => $code,
                'reason' => trim($reason)
            ];
        }
    }
    return $records;
}

// Add more parsing functions as needed (classes, calendar, etc.)
