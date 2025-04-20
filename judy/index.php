<?php

$version = "1.0.10";

// ----------------------

function uuid() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

      // 32 bits for "time_low"
      mt_rand(0, 0xffff), mt_rand(0, 0xffff),

      // 16 bits for "time_mid"
      mt_rand(0, 0xffff),

      // 16 bits for "time_hi_and_version",
      // four most significant bits holds version number 4
      mt_rand(0, 0x0fff) | 0x4000,

      // 16 bits, 8 bits for "clk_seq_hi_res",
      // 8 bits for "clk_seq_low",
      // two most significant bits holds zero and one for variant DCE1.1
      mt_rand(0, 0x3fff) | 0x8000,

      // 48 bits for "node"
      mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
  }

$sessionId = uuid();
require_once $_SERVER['DOCUMENT_ROOT'] . "/judy/private/preproc.php";

$build = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/judy/private/builds.txt");
$parts = explode("|", $build);

if (filemtime($_SERVER['DOCUMENT_ROOT'] . "/" . $_SERVER['PHP_SELF']) != (int)$parts[1]) {
    $parts[0] = (int)$parts[0] + 1;
    $parts[1] = filemtime($_SERVER['DOCUMENT_ROOT'] . "/" . $_SERVER['PHP_SELF']);
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/judy/private/builds.txt", implode("|", $parts));
}

?>
<!DOCTYPE html>
<html>

    <head>
        <title>Judy, par Familine</title>
        <link rel="shortcut icon" href="/judy/logo.svg" type="image/svg">
        <link rel="stylesheet" href="/judy/styles.css">
        <script src="https://legacy.familine.minteck.org/cdn/script/jquery.js"></script>
        <script>hooks = [];user = "<?= $_USER ?>";location.hash = "/<?= $sessionId ?>";uuid="<?= $sessionId ?>";</script>
    </head>
    
    <body>
        <div id="inner">
            <!-- Debugging Info -->
            <div id="debug">
            <?= $version ?>-<?= filemtime($_SERVER['DOCUMENT_ROOT'] . "/" . $_SERVER['PHP_SELF']) ?><br>#<?= $parts[0] ?> <?php
            
            $dt = new DateTime("@" . $parts[1]);
            echo $dt->format('D M d H:i:s T Y');
            
            ?><br>Session ID: <?= $sessionId ?>
            </div>
            
            <!-- Beta information -->
            <div id="beta-box"><span id="beta-inner"><span id="beta">ALPHA</span></span></div>
        
            <!-- Background -->
            <div id="bg-img"></div>
            <div id="bg-layer"></div>
        
            <!-- Click-to-Start -->
            <div id="cts">
                <div id="cts-text" style="display:none;" onclick="cts_trigger();">Cliquez ou touchez pour commencer</div>
            </div>
        
            <!-- Sound Manager -->
            <audio id="bgm" loop></audio>
            <script>document.getElementById('bgm').volume = .3;</script>
            <audio id="voice"></audio>
            <script>
            
            hooks.push(() => {
                document.getElementById('bgm').src = "/judy/getres.php?_=bgm.mp3";
                document.getElementById('bgm').play();
            });
            
            </script>
            
            <!-- Subtitles -->
            <div id="subtitles" style="display:none;"></div>
            
            <!-- Logo -->
            <?= file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/judy/logo.svg"); ?>
            <script>document.getElementById('svg8').classList.add('opacity');</script>
            
            <!-- Different Screens -->
            <div id="tasks" class="options" style="display:none;">
                <div onclick="screen_search();"><img src="https://legacy.familine.minteck.org/cdn/material/ic_search_24px.svg"><br>Trouver quelque chose</div>
                <div><img src="https://legacy.familine.minteck.org/cdn/material/ic_edit_24px.svg"><br>Modifier ma page</div>
                <div><img src="https://legacy.familine.minteck.org/cdn/material/ic_description_24px.svg"><br>Voir les crédits</div>
            </div>
            
            <div id="searchfor" class="options withback" style="display:none;">
                <div onclick="screen_tasks1();" class="optback"><img src="https://legacy.familine.minteck.org/cdn/material/ic_arrow_back_24px.svg"></div>
                <div onclick="screen_articles();"><img src="https://legacy.familine.minteck.org/cdn/material/ic_book_24px.svg"><br>Articles</div>
                <div onclick="screen_users();"><img src="https://legacy.familine.minteck.org/cdn/material/ic_account_box_24px.svg"><br>Utilisateurs</div>
                <div onclick="screen_prods();"><img src="https://legacy.familine.minteck.org/cdn/material/ic_movie_24px.svg"><br>Productions</div>
            </div>
            
            <div id="articles" class="options withback withtb" style="display:none;">
                <div onclick="screen_search1();" class="optback"><img src="https://legacy.familine.minteck.org/cdn/material/ic_arrow_back_24px.svg"></div>
                <div><input class="tb" id="tb_articles" placeholder="Nom de l'article à rechercher..."></div>
                <div onclick="search_articles();"><img src="https://legacy.familine.minteck.org/cdn/material/ic_search_24px.svg"></div>
            </div>
            
            <div id="users" class="options withback withtb" style="display:none;">
                <div onclick="screen_search1();" class="optback"><img src="https://legacy.familine.minteck.org/cdn/material/ic_arrow_back_24px.svg"></div>
                <div><input class="tb" id="tb_users" placeholder="Nom de l'utilisateur à rechercher..."></div>
                <div onclick="search_users();"><img src="https://legacy.familine.minteck.org/cdn/material/ic_search_24px.svg"></div>
            </div>
            
            <div id="prods" class="options withback withtb" style="display:none;">
                <div onclick="screen_search1();" class="optback"><img src="https://legacy.familine.minteck.org/cdn/material/ic_arrow_back_24px.svg"></div>
                <div><input class="tb" id="tb_prods" placeholder="Nom de la production à rechercher..."></div>
                <div onclick="search_prods();"><img src="https://legacy.familine.minteck.org/cdn/material/ic_search_24px.svg"></div>
            </div>
            
            <div id="extract" style="display:none;">
                <div onclick="screen_tasks1();normalMode();" id="extractback" class="optback" style="display: inline-block;margin-top: 20px;"><img src="https://legacy.familine.minteck.org/cdn/material/ic_arrow_back_24px.svg"></div>
                <div id="extract_text">Lorem ipsum</div>
            </div>
            
            <!-- Final Initialization -->
            <script>
            
            window.addEventListener('load', () => {
                document.getElementById('cts-text').style.display = "";
            })
            
            function readMode() {
                rmoprogress = document.getElementById('bgm').currentTime;
                document.getElementById('bg-layer').style.backgroundColor = "rgba(0,255,0,.75)";
                document.getElementById('bgm').src = "/judy/getres.php?_=article.mp3";
                document.getElementById('bgm').play();
                $("#extractback").hide(0);
            }
            
            function normalMode() {
                document.getElementById('bg-layer').style.backgroundColor = "rgba(0,0,255,.75)";
                document.getElementById('bgm').src = "/judy/getres.php?_=bgm.mp3";
                document.getElementById('bgm').play();
            }
            
            function cts_trigger() {
                $("#cts").fadeOut(200);
                hooks.forEach((_e, i) => {
                    hooks[i]();
                })
                document.getElementById('svg8').classList.remove('opacity');
                speak("Bonjour " + user + ", j'espère que vous allez bien. Je suis Judy, et je suis là pour rendre votre expérience de navigation plus amusante.")
                
                onPlayDone = () => {
                    speak("Pour commencer, que voulez-vous faire aujourd'hui ?");
                    screen_tasks();
                }
            }
            
            function screen_search() {
                $(".options").hide(200);
                speak("Très bien, quel type de contenu cherchez-vous ?");
                onPlayDone = () => {
                    $("#searchfor").show(200);
                }
            }
            
            function screen_search1() {
                $(".options").hide(200);
                speak("Quel type de contenu cherchez-vous ?");
                onPlayDone = () => {
                    $("#searchfor").show(200);
                }
            }
            
            function screen_articles() {
                $(".options").hide(200);
                speak("Super. Cliquez ou touchez la zone de texte, entrez votre demande, et cliquez ou touchez la loupe pour rechercher les articles disponibles sur Famiwiki.");
                onPlayDone = () => {
                    $("#articles").show(200);
                }
            }
            
            function screen_users() {
                $(".options").hide(200);
                speak("Fantastique ! Cliquez ou touchez la zone de texte, entrez votre demande, et cliquez ou touchez la loupe pour rechercher les utilisateurs inscrits sur Familine.");
                onPlayDone = () => {
                    $("#users").show(200);
                }
            }
            
            function screen_prods() {
                $(".options").hide(200);
                speak("Formidable ! Cliquez ou touchez la zone de texte, entrez votre demande, et cliquez ou touchez la loupe pour rechercher les productions référencées sur le site de Famiprods.");
                onPlayDone = () => {
                    $("#prods").show(200);
                }
            }
            
            function search_articles() {
                query = document.getElementById('tb_articles').value;
                $(".options").hide(200);
                speak("Aucun problème. Laissez moi juste un instant pendant que je cherche un article correspondant à « " + query + " ».");
                onPlayDone = () => {
                    $.ajax("https://legacy.familine.minteck.org/net.familine.Famiwiki/api.php?action=query&list=search&srsearch=" + encodeURI(query) + "&srprop=wordcount|snippet&srlimit=1&srnamespace=0&format=json", {
                        cache: false,
                        success: (data) => {
                            console.log(data);
                            if (data.query.search.length > 0) {
                                speak("Ah, j'ai trouvé ! Encore un petit instant.");
                                onPlayDone = () => {
                                    $.ajax("https://legacy.familine.minteck.org/net.familine.Famiwiki/api.php?action=query&prop=extracts&exintro=true&exlimit=1&titles=" + encodeURI(data.query.search[0].title) + "&explaintext=1&formatversion=2&format=json", {
                                        cache: false,
                                        success: (odata) => {
                                            console.log(odata);
                                            intro = odata.query.pages[0].extract;
                                            speak("Terminé ! J'ai trouvé un article nommé « " + data.query.search[0].title + " »");
                                            onPlayDone = () => {
                                                document.getElementById('extract_text').innerText = intro;
                                                $("#extract").show(200);
                                                readMode();
                                                setTimeout(() => {
                                                    speak("Selon Famiwiki : " + intro);
                                                    onPlayDone = () => {
                                                        speak("Patientez, je prépare la suite.");
                                                        onPlayDone = () => {
                                                            $.ajax("https://legacy.familine.minteck.org/net.familine.Famiwiki/api.php?action=query&prop=extracts&exlimit=3&exchars=550&titles=" + encodeURI(data.query.search[0].title) + "&explaintext=1&formatversion=2&format=json", {
                                                                cache: false,
                                                                success: (odata) => {
                                                                    console.log(odata);
                                                                    intro = odata.query.pages[0].extract.replaceAll("\t", " ").replaceAll("\n", " ").replaceAll("==", ".").replaceAll("===", ".").replaceAll("====", ".").replaceAll("=====", ".").replaceAll("======", ".");
                                                                    setTimeout(() => {
                                                                        speak("Et voici : " + intro);
                                                                        onPlayDone = () => {
                                                                            speak("Voilà, on s'arrête là. Pour lire l'article complet, veuillez consulter Famiwiki.");
                                                                            $("#extractback").show(200);
                                                                        }
                                                                    }, 1000)
                                                                },
                                                                error: (err) => {
                                                                    throw new Error("Request failed: " + JSON.stringify(err));
                                                                }
                                                            });
                                                        }
                                                    }
                                                }, 1000)
                                            }
                                        },
                                        error: (err) => {
                                            throw new Error("Request failed: " + JSON.stringify(err));
                                        }
                                    });
                                }
                            } else {
                                speak("Malheureusement, il n'y a aucun résultat correspondant à votre recherche.");
                                onPlayDone = () => {
                                    screen_tasks1();
                                };
                            }
                        },
                        error: (err) => {
                            throw new Error("Request failed: " + JSON.stringify(err));
                        }
                    });
                }
            }
            
            function search_prods() {
                query = document.getElementById('tb_prods').value;
                $(".options").hide(200);
                speak("Ça marche. Laissez moi juste un instant pendant que je cherche une production correspondant à « " + query + " ».");
                onPlayDone = () => {
                    $.ajax("https://legacy.familine.minteck.org/net.familine.Famiwiki/api.php?action=query&list=search&srsearch=" + encodeURI(query) + "&srprop=wordcount|snippet&srlimit=1&srnamespace=0&format=json", {
                        cache: false,
                        success: (data) => {
                            console.log(data);
                            if (data.query.search.length > 0) {
                                speak("Bien, j'ai trouvé ! Encore un petit instant.");
                                onPlayDone = () => {
                                    $.ajax("https://legacy.familine.minteck.org/net.familine.Famiprods/api.php?action=query&prop=extracts&exintro=true&exlimit=1&titles=" + encodeURI(data.query.search[0].title) + "&explaintext=1&formatversion=2&format=json", {
                                        cache: false,
                                        success: (odata) => {
                                            console.log(odata);
                                            intro = odata.query.pages[0].extract;
                                            speak("Fini ! J'ai trouvé une production nommée « " + data.query.search[0].title + " »");
                                            onPlayDone = () => {
                                                document.getElementById('extract_text').innerText = intro;
                                                $("#extract").show(200);
                                                readMode();
                                                setTimeout(() => {
                                                    speak("Selon Famiprods.net : " + intro);
                                                    onPlayDone = () => {
                                                        speak("Patientez, je prépare la suite.");
                                                        onPlayDone = () => {
                                                            $.ajax("https://legacy.familine.minteck.org/net.familine.Famiprods/api.php?action=query&prop=extracts&exlimit=3&exchars=550&titles=" + encodeURI(data.query.search[0].title) + "&explaintext=1&formatversion=2&format=json", {
                                                                cache: false,
                                                                success: (odata) => {
                                                                    console.log(odata);
                                                                    intro = odata.query.pages[0].extract.replaceAll("\t", " ").replaceAll("\n", " ").replaceAll("==", ".").replaceAll("===", ".").replaceAll("====", ".").replaceAll("=====", ".").replaceAll("======", ".");
                                                                    setTimeout(() => {
                                                                        speak("Et voici : " + intro);
                                                                        onPlayDone = () => {
                                                                            speak("Bien, on s'arrête là. Pour lire l'article complet, veuillez consulter Famiprods.net.");
                                                                            $("#extractback").show(200);
                                                                        }
                                                                    }, 1000)
                                                                },
                                                                error: (err) => {
                                                                    throw new Error("Request failed: " + JSON.stringify(err));
                                                                }
                                                            });
                                                        }
                                                    }
                                                }, 1000)
                                            }
                                        },
                                        error: (err) => {
                                            throw new Error("Request failed: " + JSON.stringify(err));
                                        }
                                    });
                                }
                            } else {
                                speak("Oh non, je n'ai trouvé aucun résultat correspondant à votre recherche.");
                                onPlayDone = () => {
                                    screen_tasks1();
                                };
                            }
                        },
                        error: (err) => {
                            throw new Error("Request failed: " + JSON.stringify(err));
                        }
                    });
                }
            }
            
            function search_users() {
                query = document.getElementById('tb_users').value;
                $(".options").hide(200);
                speak("Pas de soucis. Laissez moi juste un instant pendant que je cherche un utilisateur correspondant à « " + query + " ».");
                onPlayDone = () => {
                    $.ajax("https://legacy.familine.minteck.org/net.familine.Famiwiki/api.php?action=query&list=search&srsearch=" + encodeURI(query) + "&srprop=wordcount|snippet&srlimit=1&srnamespace=2&format=json", {
                        cache: false,
                        success: (data) => {
                            console.log(data);
                            if (data.query.search.length > 0) {
                                speak("Ça y est, j'ai trouvé ! Encore un petit instant.");
                                onPlayDone = () => {
                                    $.ajax("https://legacy.familine.minteck.org/net.familine.Famiwiki/api.php?action=query&prop=extracts&exintro=true&exlimit=1&titles=" + encodeURI(data.query.search[0].title) + "&explaintext=1&formatversion=2&format=json", {
                                        cache: false,
                                        success: (odata) => {
                                            console.log(odata);
                                            intro = odata.query.pages[0].extract;
                                            speak("C'est bon ! J'ai trouvé un utilisateur nommé « " + data.query.search[0].title.split(":")[1] + " »");
                                            onPlayDone = () => {
                                                document.getElementById('extract_text').innerText = intro;
                                                $("#extract").show(200);
                                                readMode();
                                                setTimeout(() => {
                                                    speak("Selon la page de " + data.query.search[0].title.split(":")[1] + " : " + intro);
                                                    onPlayDone = () => {
                                                        speak("Patientez, je prépare la suite.");
                                                        onPlayDone = () => {
                                                            $.ajax("https://legacy.familine.minteck.org/net.familine.Famiwiki/api.php?action=query&prop=extracts&exlimit=3&exchars=550&titles=" + encodeURI(data.query.search[0].title) + "&explaintext=1&formatversion=2&format=json", {
                                                                cache: false,
                                                                success: (odata) => {
                                                                    console.log(odata);
                                                                    intro = odata.query.pages[0].extract.replaceAll("\t", " ").replaceAll("\n", " ").replaceAll("==", ".").replaceAll("===", ".").replaceAll("====", ".").replaceAll("=====", ".").replaceAll("======", ".");
                                                                    setTimeout(() => {
                                                                        speak("Et voici : " + intro);
                                                                        onPlayDone = () => {
                                                                            speak("On en reste là. Pour lire la page complète, veuillez consulter la page de cet utilisateur sur Famiwiki.");
                                                                            $("#extractback").show(200);
                                                                        }
                                                                    }, 1000)
                                                                },
                                                                error: (err) => {
                                                                    throw new Error("Request failed: " + JSON.stringify(err));
                                                                }
                                                            });
                                                        }
                                                    }
                                                }, 1000)
                                            }
                                        },
                                        error: (err) => {
                                            throw new Error("Request failed: " + JSON.stringify(err));
                                        }
                                    });
                                }
                            } else {
                                speak("Quel dommage, je ne parviens pas à trouver un seul résultat correspondant à votre recherche.");
                                onPlayDone = () => {
                                    screen_tasks1();
                                };
                            }
                        },
                        error: (err) => {
                            throw new Error("Request failed: " + JSON.stringify(err));
                        }
                    });
                }
            }
            
            function screen_tasks() {
                $(".options").hide(200);
                onPlayDone = () => {
                    $("#tasks").show(200);
                }
            }
            
            function screen_tasks1() {
                $(".options").hide(200);
                $("#extract").hide(200);
                speak("Que voulez-vous faire aujourd'hui ?");
                onPlayDone = () => {
                    $("#tasks").show(200);
                }
            }
            
            function speak(text) {
                b64 = btoa(unescape(encodeURIComponent(text)));
                document.getElementById('voice').src = "/judy/tts.php?t=" + b64;
                document.getElementById('voice').play();
                document.getElementById('subtitles').innerText = text;
            }
            
            document.getElementById('voice').addEventListener('playing', () => {
                document.getElementById('bgm').volume = .07;
                document.getElementById('svg8').classList.add('opacity');
                $("#subtitles").fadeIn(200);
            })
            
            document.getElementById('bgm').addEventListener('playing', () => {
                if (typeof rmoprogress != "undefined" && document.getElementById('bgm').src == "https://legacy.familine.minteck.org/judy/getres.php?_=bgm.mp3") {
                    document.getElementById('bgm').currentTime = rmoprogress;
                    delete rmoprogress;
                }
            })
            
            document.getElementById('voice').addEventListener('pause', () => {
                document.getElementById('bgm').volume = .3;
                document.getElementById('svg8').classList.remove('opacity');
                $("#subtitles").fadeOut(200);
                if (typeof onPlayDone == "function") {
                    opd_current = onPlayDone;
                    delete onPlayDone;
                    opd_current();
                }
            })
            
            window.onerror = () => {
                speak("Une erreur s'est produite, essayez à nouveau dans quelques instants.");
                document.getElementById('bg-layer').style.backgroundColor = "rgba(255,0,0,.75)";
            };
            
            </script>
        </div>
    </body>

</html>
