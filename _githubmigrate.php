<?php

die();
$proj = (string)escapeshellcmd($_POST['p']);
$_POST = json_decode($_POST['payload'], true);
file_put_contents("./ghmigrinp.json", json_encode($_POST, JSON_PRETTY_PRINT));

exec('curl -X GET https://jetbrains.minteck.ro.lt:1024/youtrack/api/admin/projects/?fields=id,shortName -H "Authorization: Bearer perm:Z2g=.NDctMA==.W0WnhZUe2velLxBTRQB7KGYE1tHmuR" -H "Content-Type: application/json" -H "Accept: application/json"', $projs_raw);
$projs = json_decode(implode("\n", $projs_raw), true);

if ($_POST["action"] == "opened") {
    $id = (string)escapeshellcmd($_POST["issue"]["number"]);
    $url = (string)escapeshellcmd($_POST["issue"]["html_url"]);
    $repos = (string)escapeshellcmd($_POST["repository"]["full_name"]);
    $disp = (string)escapeshellcmd($_POST["repository"]["name"]);
    $user = (string)escapeshellcmd($_POST["issue"]["user"]["login"]);
    $title = (string)str_replace("\\", '\\\\', escapeshellcmd($_POST["issue"]["title"]));
    $cnt = (string)str_replace("\\", '\\\\', escapeshellcmd($_POST["issue"]["body"]));

    $pid = null;
    foreach ($projs as $proju) {
        if ($proju["shortName"] === $proj) {
            $pid = $proju["id"];
        }
    }
    if (is_null($pid)) {
        header("HTTP/1.1 500 Internal Server Error");
        die();
    }

    exec("curl -X POST https://jetbrains.minteck.ro.lt:1024/youtrack/api/issues?fields=idReadable -H \"Authorization: Bearer perm:Z2g=.NDctMA==.W0WnhZUe2velLxBTRQB7KGYE1tHmuR\" -H \"Content-Type: application/json\" -H \"Accept: application/json\" -d '{\"summary\": \"{$title} [from {$user} on GitHub]\",\"description\": \"**This issue has been migrated from GitHub.** [Original issue]({$url})\\n\\n---\\n\\n{$cnt}\",\"project\": {\"id\": \"{$pid}\"}}'", $ret);
    file_put_contents("./ghmigrout.json", json_encode($ret, JSON_PRETTY_PRINT));
    exec("curl -X POST -H \"Authorization: token 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\" -H \"Accept: application/vnd.github.v3+json\" https://api.github.com/repos/{$repos}/issues/{$id}/comments -d '{\"body\":\"*This comment was sent automatically. Please do not respond to it.*\\n\\n---\\n\\nHello @{$user},\\n\\nYou opened an issue to the {$disp} project on GitHub, but we does not manage our issues on GitHub anymore. Therefore, this issue has been moved to my YouTrack instance: https://jetbrains.minteck.ro.lt:1024/youtrack/issue/" . json_decode($ret[count($ret) - 1], true)["idReadable"] . "\\n\\nThe issue on GitHub is now closed. For any new updates on this, please view the issue on my YouTrack; you can register on there using your GitHub account to comment about this issue directly on YouTrack.\\n\\nSincerely,<br>Minteck\"}'", $ret);
    file_put_contents("./ghmigrout.json", json_encode($ret, JSON_PRETTY_PRINT));
    exec("curl -X PATCH -H \"Authorization: token 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\" -H \"Accept: application/vnd.github.v3+json\" https://api.github.com/repos/{$repos}/issues/{$id} -d '{\"state\":\"closed\"}'", $ret);
    file_put_contents("./ghmigrout.json", json_encode($ret, JSON_PRETTY_PRINT));
    exec("curl -X PUT -H \"Authorization: token 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\" -H \"Accept: application/vnd.github.v3+json\" https://api.github.com/repos/{$repos}/issues/{$id}/lock -d '{\"lock_reason\":\"off-topic\"}'", $ret);
    file_put_contents("./ghmigrout.json", json_encode($ret, JSON_PRETTY_PRINT));
}
