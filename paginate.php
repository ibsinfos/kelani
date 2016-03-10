<?php
function paginate($reload, $page, $tpages) {
    $adjacents = 10;
    $prevlabel = "&lsaquo; Prev";
    $nextlabel = "Next &rsaquo;";
    $out = "";
    // previous
    if ($page == 1) {
        $out.= "<li><span aria-hidden=\"true\">&laquo;</span>\n</li>";
    } elseif ($page == 2) {
        $out.="<li><a href=\"".$reload."\">&laquo;</a>\n</li>";
    } else {
        $out.="<li><a href=\"".$reload."&amp;page=".($page - 1)."\">&laquo;</a>\n</li>";
    }
    $pmin=($page>$adjacents)?($page - $adjacents):1;
    $pmax=($page<($tpages - $adjacents))?($page + $adjacents):$tpages;
    for ($i = $pmin; $i <= $pmax; $i++) {
        if ($i == $page) {
            $out.= "<li class=\"active\"><a href=''>".$i."</a></li>\n";
        } elseif ($i == 1) {
            $out.= "<li><a href=\"".$reload."\">".$i."</a>\n</li>";
        } else {
            $out.= "<li><a href=\"".$reload. "&amp;page=".$i."\">".$i. "</a>\n</li>";
        }
    }

    if ($page<($tpages - $adjacents)) {
        $out.= "<a style='font-size:11px' href=\"" . $reload."&amp;page=".$tpages."\">" .$tpages."</a>\n";
    }
    // next
    if ($page < $tpages) {
        $out.= "<li><a href=\"".$reload."&amp;page=".($page + 1)."\">&raquo;</a>\n</li>";
    } else {
        $out.= "<li><span aria-hidden=\"true\">&raquo;</span>\n</li>";
    }
    $out.= "";
    return $out;
}
?>