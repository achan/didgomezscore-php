<?php 
    $user_locale = isset($_GET["locale"]) ? $_GET["locale"] : (isset($_COOKIE["locale"]) ? $_COOKIE["locale"] : "en");
    setcookie("locale", $user_locale);

    $locales = array("fr"=>"fr_FR", "en"=>"en_US");
    $locale = $locales[$user_locale];
    $number_format_locale = $user_locale == "en" ? "us" : "fr";
    $other_user_locale = $user_locale == "en" ? "fr" : "en";

    putenv('LC_ALL=' . $locale);
    setlocale(LC_ALL, $locale);

    // Specify location of translation tables
    bindtextdomain("default", "./locale");

    // Choose domain
    textdomain("default");

    $score_file = "../scored.txt";
    $did_he_score = false;
    $shootout = false;
    $shutout = false;

    if (file_exists($score_file)) {
        $handle = fopen($score_file, "r");
        $result = trim(fread($handle, filesize($score_file)));
        fclose($handle);
        $did_he_score = $result == "true";
        $shootout = $result == "shootout";
        $shutout = $result == "shutout";
    } else {
        $did_he_score = false;
    }
?><!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo _("Did Scott Gomez Score Last Game?"); ?></title>
        <link rel="icon" href="dgs.ico" type="image/x-icon">
        <link rel="shortcut icon" href="dgs.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>
        <link rel="stylesheet" type="text/css" href="css/styles.css"/>
        <link rel="stylesheet" type="text/css" href="css/styles-<?php echo $user_locale; ?>.css"/>
        <?php if ($did_he_score) { ?>
        <!--link rel="stylesheet" type="text/css" href="css/styles-scored.css"/>-->
        <?php } ?>
        <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="description" content="Did Scott Gomez Score Last Night/Game?"/>
        <meta charset="utf-8">
        <meta property="og:title" content="Did Scott Gomez Score Last Game?" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="http://didgomezscore.com" />
        <meta property="og:image" content="http://didgomezscore.com/gomez.png" />
        <meta property="og:site_name" content="Did Scott Gomez Score Last Game?" />
        <meta property="fb:admins" content="1252352623" />
        <meta property="og:description" content="Did Scott Gomez score last game? Find out now!" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.countdown.min.js"></script>
        <script type="text/javascript" src="js/jshashtable-2.1.js"></script>
        <script type="text/javascript" src="js/jquery.numberformatter-1.2.2.min.js"></script>
        <?php if ($did_he_score) { ?>
        <script type="text/javascript" src="js/jquery.snowfall.min.js"></script>
        <?php } ?>
        <script type="text/javascript">
            //var firstGoal = new Date(Date.UTC(2012, 1, 10, 2, 07));
            var lastGoal = new Date(Date.UTC(2012, 1, 17, 20, 18));
            var _gaq = _gaq || []; 
            _gaq.push(['_setAccount', 'UA-28519444-1']); 
            _gaq.push(['_trackPageview']); 
            
            (function() { 
                var ga = document.createElement('script'); 
                ga.type = 'text/javascript'; 
                ga.async = true; 
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js'; 
                var s = document.getElementsByTagName('script')[0]; 
                s.parentNode.insertBefore(ga, s); 
            })(); 
        </script>
    </head>
    <body class="red">
        <div class="container">
            <div id="fb-root"></div>
            <script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=316542338389694"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));</script>
            <div class="row">
                <div class="span12" style="overflow: hidden">
                    <script type="text/javascript"><!--
                    google_ad_client = "ca-pub-3618440658775904";
                    /* top text links */
                    google_ad_slot = "2103406911";
                    google_ad_width = 468;
                    google_ad_height = 15;
                    //-->
                    </script>
                    <script type="text/javascript"
                    src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                    </script>
                </div>
            </div>
            <div class="row">
                <div class="span12">
                    <h1>
                        <?php echo $shutout ? _("Did The Habs Score Last Game?") : _("Did Scott Gomez Score Last Game?"); ?>
                        <small id="now"><a id="locale-switcher" class="header-link" href="/<?php echo $other_user_locale; ?>" ?><?php echo _("Et pis maintenant?"); ?></a></small>
                    </h1>
                </div>
            </div>
            <?php if ($did_he_score) { ?>
            <div class="row">
                <div id="congrats" class="span4">
                    <?php //<a href="http://imgur.com/YZPS5" title="imgur.com"><img src="http://i.imgur.com/YZPS5.gif" /></a> ?>
                    <a href="http://imgur.com/USiEX" title="imgur.com"><img src="http://i.imgur.com/USiEX.jpg" /></a>
                </div>
                <div class="span8 answer scored">
                    <?php echo _("Yes!"); ?>
                </div>
            </div>
            <?php } else {  ?>
            <div class="row">
                <div class="span8 answer didnt-score">
                    <?php echo _("No."); ?>
                </div>
                <div id="countup" class="span4"></div>
            </div>
            <?php } ?>

            <?php if ($did_he_score) { ?>
            <div class="row">
                <div id="more" class="span12">
                    <?php echo _("Hire Gomez now! Appearance fees: $3.75MM/Goal, $50k/Hole-in-one (Bargain!)."); ?>
                    <?php //echo _("Watch out Cam Ward, Scott Gomez is coming for you!"); ?>
                </div>
            </div>
            <?php } else if ($shootout) { ?>
            <div class="row">
                <div id="more" class="span12">
                    <?php echo _("Sorry Scottie, but shootout goals don&apos;t count :("); ?>
                </div>
            </div>
            <?php } ?>
            <div class="row social">
                <div id="social-facebook" class="span8">
                    <div class="fb-like" data-href="http://didgomezscore.com" data-send="true" data-width="620" data-show-faces="true"></div>
                </div>
                <div id="social-twitter" class="span4">
                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://didgomezscore.com" data-text="Let's reminisce about the last time Gomez scored!" data-hashtags="LastTimeGomezScored">Tweet</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                </div>
            </div>
        </div>
        <div class="new-section desktop ads">
            <script type="text/javascript"><!--
            google_ad_client = "ca-pub-3618440658775904";
            /* medium mobile */
            google_ad_slot = "1989771843";
            google_ad_width = 300;
            google_ad_height = 250;
            //-->
            </script>
            <script type="text/javascript"
            src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
            </script>
        </div>
        <?php if (!$did_he_score) { ?>
        <?php if (false) { ?>
        <div class="container">
            <div class="row">
                <h2 class="span12"><?php echo _("Show Me the Money..."); ?></h2>
            </div>
            <div class="row">
                <div id="facts" class="span12">
                    <?php echo sprintf(_("Scott Gomez has been paid %s by the Montreal Canadiens since his last goal."), "<span id=\"salary\">" . _("too much") . "</span>"); ?>
                </div>
            </div>
        </div>
        <div class="new-section desktop ads">
            <script type="text/javascript"><!--
            google_ad_client = "ca-pub-3618440658775904";
            /* medium mobile */
            google_ad_slot = "1989771843";
            google_ad_width = 300;
            google_ad_height = 250;
            //-->
            </script>
            <script type="text/javascript"
            src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
            </script>
        </div>
        <?php } ?>
        <div class="container">
            <div class="row">
                <h2 class="span12"><?php echo _("Reminiscing..."); ?></h2>
            </div>
            <div class="row">
                <div id="last-goal-description" class="span12">
                    <?php echo _("last.goal.desc"); //At <a href="http://sports.yahoo.com/nhl/boxscore?gid=2011020510">18:34 of the second period</a>, Scott Gomez puts home a game-winning shot past Martin Biron to help lift the Montreal Canadiens past the New York Rangers on February 5, 2011. ?>
                </div>
            </div>
            <div class="row">
                <div id="last-goal-showcase" class="span12">
                    <iframe id="last-goal-youtube" align="center" width="100%" height="480" src="http://www.youtube.com/embed/C6Rf3QxAK8E?rel=0" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="new-section desktop ads">
            <script type="text/javascript"><!--
            google_ad_client = "ca-pub-3618440658775904";
            /* medium mobile */
            google_ad_slot = "1989771843";
            google_ad_width = 300;
            google_ad_height = 250;
            //-->
            </script>
            <script type="text/javascript"
            src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
            </script>
        </div>
        <?php } ?>
        <div class="container">
            <?php if ($did_he_score) { ?>
            <div class="row">
                <h2 class="span12"><?php echo _("Congrats Gomez!!!"); ?></h2>
            </div>
            <?php } else { ?>
            <div class="row">
                <h2 class="span12"><?php echo _("Anticipation..."); ?></h2>
            </div>
            <?php } ?>
            <div class="row tweets">
            <?php 
                $twitter_json = "";
                $twitter_filename = "cache/twitter-" . date("YmdHi");
                if (file_exists($twitter_filename)) {
                    $handle = fopen($twitter_filename, "r");
                    $twitter_json = fread($handle, filesize($twitter_filename));
                    fclose($handle);
                } else {
                    $twitter_json = file_get_contents("http://search.twitter.com/search.json?q=didgomezscore&rpp=15&include_entities=f&with_twitter_user_id=true&result_type=mixed");
                    $fp = fopen($twitter_filename, 'w');
                    fwrite($fp, $twitter_json);
                    fclose($fp);
                }
                
                $results = json_decode($twitter_json);
                for ($i = 0; $i < sizeof($results->results); $i++) {
                    $result = $results->results[$i]; ?>
                    <div class="span4 blue tweet">
                        <div class="row">
                            <div class="span1 tweet-pic"><img src="<?php echo $result->profile_image_url ?>" /></div>
                            <div class="span3 tweet-desc">
                                <span class="tweet-user"><?php echo $result->from_user_name ?></span>
                                <span class="tweet-username"><?php echo "@" . $result->from_user ?></span>
                                <p class="tweet-text"><?php echo $result->text ?></p>
                            </div>
                        </div>
                    </div>
                    <?php if (($i+1) % 3 == 0) { ?>
            </div>
            <div class="row tweets">
                    <?php }
                }
            ?>
            </div>

            <script type="text/javascript">
                $("#countup").countdown({
                    format: "YdHMS",
                    since: lastGoal,
                    layout: '<?php echo _("countup.layout"); //', Only {dn} {dl}, {hn} {hl}, {mnn} {ml} and {snn} {sl} {desc}"); ?>', 
                    description: '<?php echo _("countup.description"); //since <span id="name">Gomez\'s</span> last goal...' ?>'
                });

                var HOUR_IN_MILLIS = 3600000; //less than half of gomez's yearly salary :P
                var salaryPerHour = 7500000 / (24 * 365); //$853.82;
                var trainingCamp2011 = new Date(2011, 8, 17);
                var salarySoFar = (hours_between(trainingCamp2011, new Date()) * salaryPerHour);

                //last goal $7892351.59
                //last goal ms 31901340000

                //last goal ms 

                function animate_salary(from, to) {
                    $({salary:from}).animate(
                        {salary:to}, 
                        {
                            step: function() {
                                    $("#salary").text($.formatNumber(this.salary, 
                                                                     {format:"<?php echo _("salary.format"); ?>", locale:"<?php echo $number_format_locale; ?>"}));
                                  },
                            duration: HOUR_IN_MILLIS,
                            complete: function() { animate_salary(this.salary, this.salary+salaryPerHour); },
                            easing: "linear"
                        }
                    );
                }
                
                function hours_between(date1, date2) {
                    var date1_ms = date1.getTime();
                    var date2_ms = date2.getTime();
                    
                    var difference_ms = Math.abs(date1_ms - date2_ms);
                    
                    return Math.round(difference_ms/HOUR_IN_MILLIS);
                }

            
                //animate_salary(salarySoFar,salarySoFar+salaryPerHour);
                //$("#countup").fadeOut().delay(8000).fadeIn();
                //$("#whatevz").fadeIn().delay(7500).fadeOut();

                window.scrollTo(0,1);
                <?php if ($did_he_score) { ?>
                    $(document).snowfall({flakeCount : 10, maxSpeed : 10, flakeColor: "random", round: true, maxSize: 10, deviceorientation: true});
                <?php } ?>
            </script>
            <?php if ($user_locale != "en") { ?>
                <script type="text/javascript" src="js/jquery.countdown-<?php echo $user_locale; ?>.js"></script>
            <?php } ?>
            <div class="row">
                <div id="footer" class="span12">
                    <a href="http://twitter.com/amosfreakinchan">@amosfreakinchan</a>
                    <a href="http://twitter.com/monogram_queen">@monogram_queen</a>
                </div>
            </div>
        </div>
    </body>
</html>
