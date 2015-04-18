  


<!DOCTYPE html>
<html>
  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# githubog: http://ogp.me/ns/fb/githubog#">
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>jquery-ui/ui/i18n/jquery.ui.datepicker-fr.js at master · jquery/jquery-ui · GitHub</title>
    <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="GitHub" />
    <link rel="fluid-icon" href="https://github.com/fluidicon.png" title="GitHub" />
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-114.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-144.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144.png" />
    <link rel="logo" type="image/svg" href="http://github-media-downloads.s3.amazonaws.com/github-logo.svg" />
    <link rel="xhr-socket" href="/_sockets" />


    <meta name="msapplication-TileImage" content="/windows-tile.png" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="selected-link" value="repo_source" data-pjax-transient />
    

    
    
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />

    <meta content="authenticity_token" name="csrf-param" />
<meta content="z53+gggt6FzofeQFRyNGf5VKC7JLOZhimgycTeWXRtc=" name="csrf-token" />

    <link href="https://a248.e.akamai.net/assets.github.com/assets/github-fdebe8d3f60746fb87c763a59741ff520ae3d8e8.css" media="all" rel="stylesheet" type="text/css" />
    <link href="https://a248.e.akamai.net/assets.github.com/assets/github2-d530e63e2c132c7f0e6ac7228e7e1ab9ef2a8d94.css" media="all" rel="stylesheet" type="text/css" />
    


      <script src="https://a248.e.akamai.net/assets.github.com/assets/frameworks-92d138f450f2960501e28397a2f63b0f100590f0.js" type="text/javascript"></script>
      <script src="https://a248.e.akamai.net/assets.github.com/assets/github-4037f12703c2d563310be4fcd52a229189468cce.js" type="text/javascript"></script>
      
      <meta http-equiv="x-pjax-version" content="80973bfd2a5cb09c53d745b26b5b1dc0">

        <link data-pjax-transient rel='permalink' href='/jquery/jquery-ui/blob/ce73a2688de47c975727ad9555cae84eb6997486/ui/i18n/jquery.ui.datepicker-fr.js'>
    <meta property="og:title" content="jquery-ui"/>
    <meta property="og:type" content="githubog:gitrepository"/>
    <meta property="og:url" content="https://github.com/jquery/jquery-ui"/>
    <meta property="og:image" content="https://secure.gravatar.com/avatar/6906f317a4733f4379b06c32229ef02f?s=420&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png"/>
    <meta property="og:site_name" content="GitHub"/>
    <meta property="og:description" content="jquery-ui - The official jQuery user interface library."/>
    <meta property="twitter:card" content="summary"/>
    <meta property="twitter:site" content="@GitHub">
    <meta property="twitter:title" content="jquery/jquery-ui"/>

    <meta name="description" content="jquery-ui - The official jQuery user interface library." />


    
  <link href="https://github.com/jquery/jquery-ui/commits/master.atom" rel="alternate" title="Recent Commits to jquery-ui:master" type="application/atom+xml" />

  </head>


  <body class="logged_out page-blob windows vis-public env-production  ">
    <div id="wrapper">

      

      
      
      

      
      <div class="header header-logged-out">
  <div class="container clearfix">

    <a class="header-logo-wordmark" href="https://github.com/">Github</a>

    <div class="header-actions">
      <a class="button primary" href="https://github.com/signup">Sign up</a>
      <a class="button" href="https://github.com/login?return_to=%2Fjquery%2Fjquery-ui%2Fblob%2Fmaster%2Fui%2Fi18n%2Fjquery.ui.datepicker-fr.js">Sign in</a>
    </div>

    <div class="command-bar js-command-bar  in-repository">


      <ul class="top-nav">
          <li class="explore"><a href="https://github.com/explore">Explore</a></li>
        <li class="features"><a href="https://github.com/features">Features</a></li>
          <li class="blog"><a href="https://github.com/blog">Blog</a></li>
      </ul>
        <form accept-charset="UTF-8" action="/search" class="command-bar-form" id="top_search_form" method="get">
  <a href="/search/advanced" class="advanced-search-icon tooltipped downwards command-bar-search" id="advanced_search" title="Advanced search"><span class="mini-icon mini-icon-advanced-search "></span></a>

  <input type="text" data-hotkey="/ s" name="q" id="js-command-bar-field" placeholder="Search or type a command" tabindex="1" autocapitalize="off"
    
      data-repo="jquery/jquery-ui"
      data-branch="master"
      data-sha="cecbe7d184c302c017aedb53aa9f306a54d235e9"
  >

    <input type="hidden" name="nwo" value="jquery/jquery-ui" />

    <div class="select-menu js-menu-container js-select-menu search-context-select-menu">
      <span class="minibutton select-menu-button js-menu-target">
        <span class="js-select-button">This repository</span>
      </span>

      <div class="select-menu-modal-holder js-menu-content js-navigation-container">
        <div class="select-menu-modal">

          <div class="select-menu-item js-navigation-item selected">
            <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
            <input type="radio" class="js-search-this-repository" name="search_target" value="repository" checked="checked" />
            <div class="select-menu-item-text js-select-button-text">This repository</div>
          </div> <!-- /.select-menu-item -->

          <div class="select-menu-item js-navigation-item">
            <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
            <input type="radio" name="search_target" value="global" />
            <div class="select-menu-item-text js-select-button-text">All repositories</div>
          </div> <!-- /.select-menu-item -->

        </div>
      </div>
    </div>

  <span class="mini-icon help tooltipped downwards" title="Show command bar help">
    <span class="mini-icon mini-icon-help"></span>
  </span>

    <input type="hidden" name="type" value="Code" />

  <input type="hidden" name="ref" value="cmdform">

  <div class="divider-vertical"></div>

</form>
    </div>

  </div>
</div>


      

      


            <div class="site hfeed" itemscope itemtype="http://schema.org/WebPage">
      <div class="hentry">
        
        <div class="pagehead repohead instapaper_ignore readability-menu ">
          <div class="container">
            <div class="title-actions-bar">
              

<ul class="pagehead-actions">



    <li>
      <a href="/login?return_to=%2Fjquery%2Fjquery-ui"
        class="minibutton js-toggler-target star-button entice tooltipped upwards"
        title="You must be signed in to use this feature" rel="nofollow">
        <span class="mini-icon mini-icon-star"></span>Star
      </a>
      <a class="social-count js-social-count" href="/jquery/jquery-ui/stargazers">
        7,327
      </a>
    </li>
    <li>
      <a href="/login?return_to=%2Fjquery%2Fjquery-ui"
        class="minibutton js-toggler-target fork-button entice tooltipped upwards"
        title="You must be signed in to fork a repository" rel="nofollow">
        <span class="mini-icon mini-icon-fork"></span>Fork
      </a>
      <a href="/jquery/jquery-ui/network" class="social-count">
        2,272
      </a>
    </li>
</ul>

              <h1 itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="entry-title public">
                <span class="repo-label"><span>public</span></span>
                <span class="mega-icon mega-icon-public-repo"></span>
                <span class="author vcard">
                  <a href="/jquery" class="url fn" itemprop="url" rel="author">
                  <span itemprop="title">jquery</span>
                  </a></span> /
                <strong><a href="/jquery/jquery-ui" class="js-current-repository">jquery-ui</a></strong>
              </h1>
            </div>

            
  <ul class="tabs">
    <li class="pulse-nav"><a href="/jquery/jquery-ui/pulse" class="js-selected-navigation-item " data-selected-links="pulse /jquery/jquery-ui/pulse" rel="nofollow"><span class="mini-icon mini-icon-pulse"></span></a></li>
    <li><a href="/jquery/jquery-ui" class="js-selected-navigation-item selected" data-selected-links="repo_source repo_downloads repo_commits repo_tags repo_branches /jquery/jquery-ui">Code</a></li>
    <li><a href="/jquery/jquery-ui/network" class="js-selected-navigation-item " data-selected-links="repo_network /jquery/jquery-ui/network">Network</a></li>
    <li><a href="/jquery/jquery-ui/pulls" class="js-selected-navigation-item " data-selected-links="repo_pulls /jquery/jquery-ui/pulls">Pull Requests <span class='counter'>30</span></a></li>




    <li><a href="/jquery/jquery-ui/graphs" class="js-selected-navigation-item " data-selected-links="repo_graphs repo_contributors /jquery/jquery-ui/graphs">Graphs</a></li>


  </ul>
  
<div class="tabnav">

  <span class="tabnav-right">
    <ul class="tabnav-tabs">
          <li><a href="/jquery/jquery-ui/tags" class="js-selected-navigation-item tabnav-tab" data-selected-links="repo_tags /jquery/jquery-ui/tags">Tags <span class="counter ">58</span></a></li>
    </ul>
  </span>

  <div class="tabnav-widget scope">


    <div class="select-menu js-menu-container js-select-menu js-branch-menu">
      <a class="minibutton select-menu-button js-menu-target" data-hotkey="w" data-ref="master">
        <span class="mini-icon mini-icon-branch"></span>
        <i>branch:</i>
        <span class="js-select-button">master</span>
      </a>

      <div class="select-menu-modal-holder js-menu-content js-navigation-container">

        <div class="select-menu-modal">
          <div class="select-menu-header">
            <span class="select-menu-title">Switch branches/tags</span>
            <span class="mini-icon mini-icon-remove-close js-menu-close"></span>
          </div> <!-- /.select-menu-header -->

          <div class="select-menu-filters">
            <div class="select-menu-text-filter">
              <input type="text" id="commitish-filter-field" class="js-filterable-field js-navigation-enable" placeholder="Filter branches/tags">
            </div>
            <div class="select-menu-tabs">
              <ul>
                <li class="select-menu-tab">
                  <a href="#" data-tab-filter="branches" class="js-select-menu-tab">Branches</a>
                </li>
                <li class="select-menu-tab">
                  <a href="#" data-tab-filter="tags" class="js-select-menu-tab">Tags</a>
                </li>
              </ul>
            </div><!-- /.select-menu-tabs -->
          </div><!-- /.select-menu-filters -->

          <div class="select-menu-list select-menu-tab-bucket js-select-menu-tab-bucket css-truncate" data-tab-filter="branches">

            <div data-filterable-for="commitish-filter-field" data-filterable-type="substring">

                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1-8-stable/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1-8-stable" rel="nofollow" title="1-8-stable">1-8-stable</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1-9-stable/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1-9-stable" rel="nofollow" title="1-9-stable">1-9-stable</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1-10-stable/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1-10-stable" rel="nofollow" title="1-10-stable">1-10-stable</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/cutoff-duplicate-parts-with-download-builder/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="cutoff-duplicate-parts-with-download-builder" rel="nofollow" title="cutoff-duplicate-parts-with-download-builder">cutoff-duplicate-parts-with-download-builder</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/datepicker/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="datepicker" rel="nofollow" title="datepicker">datepicker</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/editable/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="editable" rel="nofollow" title="editable">editable</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/fix-5816/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="fix-5816" rel="nofollow" title="fix-5816">fix-5816</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/fix-event-keycode/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="fix-event-keycode" rel="nofollow" title="fix-event-keycode">fix-event-keycode</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/formcontrols/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="formcontrols" rel="nofollow" title="formcontrols">formcontrols</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/grid/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="grid" rel="nofollow" title="grid">grid</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/interactions/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="interactions" rel="nofollow" title="interactions">interactions</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/interactions-pointer/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="interactions-pointer" rel="nofollow" title="interactions-pointer">interactions-pointer</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/mask/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="mask" rel="nofollow" title="mask">mask</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item selected">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/master/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="master" rel="nofollow" title="master">master</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/menubar/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="menubar" rel="nofollow" title="menubar">menubar</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/pr/982/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="pr/982" rel="nofollow" title="pr/982">pr/982</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/progressbar/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="progressbar" rel="nofollow" title="progressbar">progressbar</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/qunit_connect/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="qunit_connect" rel="nofollow" title="qunit_connect">qunit_connect</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/scale-size-puff-effects/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="scale-size-puff-effects" rel="nofollow" title="scale-size-puff-effects">scale-size-puff-effects</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/selectmenu/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="selectmenu" rel="nofollow" title="selectmenu">selectmenu</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/unite-core-effect-demos/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="unite-core-effect-demos" rel="nofollow" title="unite-core-effect-demos">unite-core-effect-demos</a>
                </div> <!-- /.select-menu-item -->
            </div>

              <div class="select-menu-no-results">Nothing to show</div>
          </div> <!-- /.select-menu-list -->


          <div class="select-menu-list select-menu-tab-bucket js-select-menu-tab-bucket css-truncate" data-tab-filter="tags">
            <div data-filterable-for="commitish-filter-field" data-filterable-type="substring">

                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.10.3/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.10.3" rel="nofollow" title="1.10.3">1.10.3</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.10.2/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.10.2" rel="nofollow" title="1.10.2">1.10.2</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.10.1/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.10.1" rel="nofollow" title="1.10.1">1.10.1</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.10.0-rc.1/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.10.0-rc.1" rel="nofollow" title="1.10.0-rc.1">1.10.0-rc.1</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.10.0-beta.1/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.10.0-beta.1" rel="nofollow" title="1.10.0-beta.1">1.10.0-beta.1</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.10.0/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.10.0" rel="nofollow" title="1.10.0">1.10.0</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.9m7/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.9m7" rel="nofollow" title="1.9m7">1.9m7</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.9m6/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.9m6" rel="nofollow" title="1.9m6">1.9m6</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.9m5/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.9m5" rel="nofollow" title="1.9m5">1.9m5</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.9m4/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.9m4" rel="nofollow" title="1.9m4">1.9m4</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.9m3/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.9m3" rel="nofollow" title="1.9m3">1.9m3</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.9m2/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.9m2" rel="nofollow" title="1.9m2">1.9m2</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.9m1/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.9m1" rel="nofollow" title="1.9m1">1.9m1</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.9.2/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.9.2" rel="nofollow" title="1.9.2">1.9.2</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.9.1/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.9.1" rel="nofollow" title="1.9.1">1.9.1</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.9.0-rc.1/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.9.0-rc.1" rel="nofollow" title="1.9.0-rc.1">1.9.0-rc.1</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.9.0m8/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.9.0m8" rel="nofollow" title="1.9.0m8">1.9.0m8</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.9.0-beta.1/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.9.0-beta.1" rel="nofollow" title="1.9.0-beta.1">1.9.0-beta.1</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.9.0/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.9.0" rel="nofollow" title="1.9.0">1.9.0</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8rc3/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8rc3" rel="nofollow" title="1.8rc3">1.8rc3</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8rc2/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8rc2" rel="nofollow" title="1.8rc2">1.8rc2</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8rc1/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8rc1" rel="nofollow" title="1.8rc1">1.8rc1</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8b1/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8b1" rel="nofollow" title="1.8b1">1.8b1</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8a2/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8a2" rel="nofollow" title="1.8a2">1.8a2</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8a1/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8a1" rel="nofollow" title="1.8a1">1.8a1</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.24/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.24" rel="nofollow" title="1.8.24">1.8.24</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.23/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.23" rel="nofollow" title="1.8.23">1.8.23</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.22/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.22" rel="nofollow" title="1.8.22">1.8.22</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.21/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.21" rel="nofollow" title="1.8.21">1.8.21</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.20/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.20" rel="nofollow" title="1.8.20">1.8.20</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.19/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.19" rel="nofollow" title="1.8.19">1.8.19</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.18/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.18" rel="nofollow" title="1.8.18">1.8.18</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.17/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.17" rel="nofollow" title="1.8.17">1.8.17</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.16/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.16" rel="nofollow" title="1.8.16">1.8.16</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.15/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.15" rel="nofollow" title="1.8.15">1.8.15</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.14/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.14" rel="nofollow" title="1.8.14">1.8.14</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.13/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.13" rel="nofollow" title="1.8.13">1.8.13</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.12/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.12" rel="nofollow" title="1.8.12">1.8.12</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.11/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.11" rel="nofollow" title="1.8.11">1.8.11</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.10/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.10" rel="nofollow" title="1.8.10">1.8.10</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.9/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.9" rel="nofollow" title="1.8.9">1.8.9</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.8/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.8" rel="nofollow" title="1.8.8">1.8.8</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.7/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.7" rel="nofollow" title="1.8.7">1.8.7</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.6/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.6" rel="nofollow" title="1.8.6">1.8.6</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.5/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.5" rel="nofollow" title="1.8.5">1.8.5</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.4/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.4" rel="nofollow" title="1.8.4">1.8.4</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.3/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.3" rel="nofollow" title="1.8.3">1.8.3</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.2/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.2" rel="nofollow" title="1.8.2">1.8.2</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8.1/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8.1" rel="nofollow" title="1.8.1">1.8.1</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.8/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.8" rel="nofollow" title="1.8">1.8</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.7/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.7" rel="nofollow" title="1.7">1.7</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.6rc6/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.6rc6" rel="nofollow" title="1.6rc6">1.6rc6</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.6rc5/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.6rc5" rel="nofollow" title="1.6rc5">1.6rc5</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.6rc3/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.6rc3" rel="nofollow" title="1.6rc3">1.6rc3</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.6rc2/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.6rc2" rel="nofollow" title="1.6rc2">1.6rc2</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.6/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.6" rel="nofollow" title="1.6">1.6</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.5.2/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.5.2" rel="nofollow" title="1.5.2">1.5.2</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/jquery/jquery-ui/blob/1.5.1/ui/i18n/jquery.ui.datepicker-fr.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.5.1" rel="nofollow" title="1.5.1">1.5.1</a>
                </div> <!-- /.select-menu-item -->
            </div>

            <div class="select-menu-no-results">Nothing to show</div>

          </div> <!-- /.select-menu-list -->

        </div> <!-- /.select-menu-modal -->
      </div> <!-- /.select-menu-modal-holder -->
    </div> <!-- /.select-menu -->

  </div> <!-- /.scope -->

  <ul class="tabnav-tabs">
    <li><a href="/jquery/jquery-ui" class="selected js-selected-navigation-item tabnav-tab" data-selected-links="repo_source /jquery/jquery-ui">Files</a></li>
    <li><a href="/jquery/jquery-ui/commits/master" class="js-selected-navigation-item tabnav-tab" data-selected-links="repo_commits /jquery/jquery-ui/commits/master">Commits</a></li>
    <li><a href="/jquery/jquery-ui/branches" class="js-selected-navigation-item tabnav-tab" data-selected-links="repo_branches /jquery/jquery-ui/branches" rel="nofollow">Branches <span class="counter ">21</span></a></li>
  </ul>

</div>

  
  
  


            
          </div>
        </div><!-- /.repohead -->

        <div id="js-repo-pjax-container" class="container context-loader-container" data-pjax-container>
          


<!-- blob contrib key: blob_contributors:v21:978fc2e099724fc5004e1734f743e9f8 -->
<!-- blob contrib frag key: views10/v8/blob_contributors:v21:978fc2e099724fc5004e1734f743e9f8 -->


<div id="slider">
    <div class="frame-meta">

      <p title="This is a placeholder element" class="js-history-link-replace hidden"></p>

        <div class="breadcrumb">
          <span class='bold'><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/jquery/jquery-ui" class="js-slide-to" data-branch="master" data-direction="back" itemscope="url"><span itemprop="title">jquery-ui</span></a></span></span><span class="separator"> / </span><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/jquery/jquery-ui/tree/master/ui" class="js-slide-to" data-branch="master" data-direction="back" itemscope="url"><span itemprop="title">ui</span></a></span><span class="separator"> / </span><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/jquery/jquery-ui/tree/master/ui/i18n" class="js-slide-to" data-branch="master" data-direction="back" itemscope="url"><span itemprop="title">i18n</span></a></span><span class="separator"> / </span><strong class="final-path">jquery.ui.datepicker-fr.js</strong> <span class="js-zeroclipboard zeroclipboard-button" data-clipboard-text="ui/i18n/jquery.ui.datepicker-fr.js" data-copied-hint="copied!" title="copy to clipboard"><span class="mini-icon mini-icon-clipboard"></span></span>
        </div>

      <a href="/jquery/jquery-ui/find/master" class="js-slide-to" data-hotkey="t" style="display:none">Show File Finder</a>


        
  <div class="commit file-history-tease">
    <img class="main-avatar" height="24" src="https://secure.gravatar.com/avatar/945d10168a7817c64276c164a57fa8de?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="24" />
    <span class="author"><a href="/treyhunner" rel="author">treyhunner</a></span>
    <time class="js-relative-date" datetime="2012-02-27T09:04:30-08:00" title="2012-02-27 09:04:30">February 27, 2012</time>
    <div class="commit-title">
        <a href="/jquery/jquery-ui/commit/9d6e94faf4030fd287120098d7395463d8acb698" class="message">Use hard tabs for indentation consistently</a>
    </div>

    <div class="participation">
      <p class="quickstat"><a href="#blob_contributors_box" rel="facebox"><strong>5</strong> contributors</a></p>
          <a class="avatar tooltipped downwards" title="treyhunner" href="/jquery/jquery-ui/commits/master/ui/i18n/jquery.ui.datepicker-fr.js?author=treyhunner"><img height="20" src="https://secure.gravatar.com/avatar/945d10168a7817c64276c164a57fa8de?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="20" /></a>
    <a class="avatar tooltipped downwards" title="stephane" href="/jquery/jquery-ui/commits/master/ui/i18n/jquery.ui.datepicker-fr.js?author=stephane"><img height="20" src="https://secure.gravatar.com/avatar/66aa330ace3f2fd208a4a5d4640f3d99?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="20" /></a>
    <a class="avatar tooltipped downwards" title="scottgonzalez" href="/jquery/jquery-ui/commits/master/ui/i18n/jquery.ui.datepicker-fr.js?author=scottgonzalez"><img height="20" src="https://secure.gravatar.com/avatar/35da631954825179143c86fa42a10954?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="20" /></a>
    <a class="avatar tooltipped downwards" title="rdworth" href="/jquery/jquery-ui/commits/master/ui/i18n/jquery.ui.datepicker-fr.js?author=rdworth"><img height="20" src="https://secure.gravatar.com/avatar/d92ea7772f465256ad836de1ce642b37?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="20" /></a>
    <a class="avatar tooltipped downwards" title="kzys" href="/jquery/jquery-ui/commits/master/ui/i18n/jquery.ui.datepicker-fr.js?author=kzys"><img height="20" src="https://secure.gravatar.com/avatar/7828b45f8396aa361d85cead01fd99ca?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="20" /></a>


    </div>
    <div id="blob_contributors_box" style="display:none">
      <h2>Users on GitHub who have contributed to this file</h2>
      <ul class="facebox-user-list">
        <li>
          <img height="24" src="https://secure.gravatar.com/avatar/945d10168a7817c64276c164a57fa8de?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="24" />
          <a href="/treyhunner">treyhunner</a>
        </li>
        <li>
          <img height="24" src="https://secure.gravatar.com/avatar/66aa330ace3f2fd208a4a5d4640f3d99?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="24" />
          <a href="/stephane">stephane</a>
        </li>
        <li>
          <img height="24" src="https://secure.gravatar.com/avatar/35da631954825179143c86fa42a10954?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="24" />
          <a href="/scottgonzalez">scottgonzalez</a>
        </li>
        <li>
          <img height="24" src="https://secure.gravatar.com/avatar/d92ea7772f465256ad836de1ce642b37?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="24" />
          <a href="/rdworth">rdworth</a>
        </li>
        <li>
          <img height="24" src="https://secure.gravatar.com/avatar/7828b45f8396aa361d85cead01fd99ca?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="24" />
          <a href="/kzys">kzys</a>
        </li>
      </ul>
    </div>
  </div>


    </div><!-- ./.frame-meta -->

    <div class="frames">
      <div class="frame" data-permalink-url="/jquery/jquery-ui/blob/ce73a2688de47c975727ad9555cae84eb6997486/ui/i18n/jquery.ui.datepicker-fr.js" data-title="jquery-ui/ui/i18n/jquery.ui.datepicker-fr.js at master · jquery/jquery-ui · GitHub" data-type="blob">

        <div id="files" class="bubble">
          <div class="file">
            <div class="meta">
              <div class="info">
                <span class="icon"><b class="mini-icon mini-icon-text-file"></b></span>
                <span class="mode" title="File Mode">file</span>
                  <span>26 lines (25 sloc)</span>
                <span>1.008 kb</span>
              </div>
              <div class="actions">
                <div class="button-group">
                      <a class="minibutton js-entice" href=""
                         data-entice="You must be signed in and on a branch to make or propose changes">Edit</a>
                  <a href="/jquery/jquery-ui/raw/master/ui/i18n/jquery.ui.datepicker-fr.js" class="button minibutton " id="raw-url">Raw</a>
                    <a href="/jquery/jquery-ui/blame/master/ui/i18n/jquery.ui.datepicker-fr.js" class="button minibutton ">Blame</a>
                  <a href="/jquery/jquery-ui/commits/master/ui/i18n/jquery.ui.datepicker-fr.js" class="button minibutton " rel="nofollow">History</a>
                </div><!-- /.button-group -->
              </div><!-- /.actions -->

            </div>
                <div class="blob-wrapper data type-javascript js-blob-data">
      <table class="file-code file-blob">
        <tr class="file-code-line">
          <td class="blob-line-nums">
            <span id="L1" rel="#L1">1</span>
<span id="L2" rel="#L2">2</span>
<span id="L3" rel="#L3">3</span>
<span id="L4" rel="#L4">4</span>
<span id="L5" rel="#L5">5</span>
<span id="L6" rel="#L6">6</span>
<span id="L7" rel="#L7">7</span>
<span id="L8" rel="#L8">8</span>
<span id="L9" rel="#L9">9</span>
<span id="L10" rel="#L10">10</span>
<span id="L11" rel="#L11">11</span>
<span id="L12" rel="#L12">12</span>
<span id="L13" rel="#L13">13</span>
<span id="L14" rel="#L14">14</span>
<span id="L15" rel="#L15">15</span>
<span id="L16" rel="#L16">16</span>
<span id="L17" rel="#L17">17</span>
<span id="L18" rel="#L18">18</span>
<span id="L19" rel="#L19">19</span>
<span id="L20" rel="#L20">20</span>
<span id="L21" rel="#L21">21</span>
<span id="L22" rel="#L22">22</span>
<span id="L23" rel="#L23">23</span>
<span id="L24" rel="#L24">24</span>
<span id="L25" rel="#L25">25</span>

          </td>
          <td class="blob-line-code">
                  <div class="highlight"><pre><div class='line' id='LC1'><span class="cm">/* French initialisation for the jQuery UI date picker plugin. */</span></div><div class='line' id='LC2'><span class="cm">/* Written by Keith Wood (kbwood{at}iinet.com.au),</span></div><div class='line' id='LC3'><span class="cm">			  Stéphane Nahmani (sholby@sholby.net),</span></div><div class='line' id='LC4'><span class="cm">			  Stéphane Raimbault &lt;stephane.raimbault@gmail.com&gt; */</span></div><div class='line' id='LC5'><span class="nx">jQuery</span><span class="p">(</span><span class="kd">function</span><span class="p">(</span><span class="nx">$</span><span class="p">){</span></div><div class='line' id='LC6'>	<span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">regional</span><span class="p">[</span><span class="s1">&#39;fr&#39;</span><span class="p">]</span> <span class="o">=</span> <span class="p">{</span></div><div class='line' id='LC7'>		<span class="nx">closeText</span><span class="o">:</span> <span class="s1">&#39;Fermer&#39;</span><span class="p">,</span></div><div class='line' id='LC8'>		<span class="nx">prevText</span><span class="o">:</span> <span class="s1">&#39;Précédent&#39;</span><span class="p">,</span></div><div class='line' id='LC9'>		<span class="nx">nextText</span><span class="o">:</span> <span class="s1">&#39;Suivant&#39;</span><span class="p">,</span></div><div class='line' id='LC10'>		<span class="nx">currentText</span><span class="o">:</span> <span class="s1">&#39;Aujourd\&#39;hui&#39;</span><span class="p">,</span></div><div class='line' id='LC11'>		<span class="nx">monthNames</span><span class="o">:</span> <span class="p">[</span><span class="s1">&#39;Janvier&#39;</span><span class="p">,</span><span class="s1">&#39;Février&#39;</span><span class="p">,</span><span class="s1">&#39;Mars&#39;</span><span class="p">,</span><span class="s1">&#39;Avril&#39;</span><span class="p">,</span><span class="s1">&#39;Mai&#39;</span><span class="p">,</span><span class="s1">&#39;Juin&#39;</span><span class="p">,</span></div><div class='line' id='LC12'>		<span class="s1">&#39;Juillet&#39;</span><span class="p">,</span><span class="s1">&#39;Août&#39;</span><span class="p">,</span><span class="s1">&#39;Septembre&#39;</span><span class="p">,</span><span class="s1">&#39;Octobre&#39;</span><span class="p">,</span><span class="s1">&#39;Novembre&#39;</span><span class="p">,</span><span class="s1">&#39;Décembre&#39;</span><span class="p">],</span></div><div class='line' id='LC13'>		<span class="nx">monthNamesShort</span><span class="o">:</span> <span class="p">[</span><span class="s1">&#39;Janv.&#39;</span><span class="p">,</span><span class="s1">&#39;Févr.&#39;</span><span class="p">,</span><span class="s1">&#39;Mars&#39;</span><span class="p">,</span><span class="s1">&#39;Avril&#39;</span><span class="p">,</span><span class="s1">&#39;Mai&#39;</span><span class="p">,</span><span class="s1">&#39;Juin&#39;</span><span class="p">,</span></div><div class='line' id='LC14'>		<span class="s1">&#39;Juil.&#39;</span><span class="p">,</span><span class="s1">&#39;Août&#39;</span><span class="p">,</span><span class="s1">&#39;Sept.&#39;</span><span class="p">,</span><span class="s1">&#39;Oct.&#39;</span><span class="p">,</span><span class="s1">&#39;Nov.&#39;</span><span class="p">,</span><span class="s1">&#39;Déc.&#39;</span><span class="p">],</span></div><div class='line' id='LC15'>		<span class="nx">dayNames</span><span class="o">:</span> <span class="p">[</span><span class="s1">&#39;Dimanche&#39;</span><span class="p">,</span><span class="s1">&#39;Lundi&#39;</span><span class="p">,</span><span class="s1">&#39;Mardi&#39;</span><span class="p">,</span><span class="s1">&#39;Mercredi&#39;</span><span class="p">,</span><span class="s1">&#39;Jeudi&#39;</span><span class="p">,</span><span class="s1">&#39;Vendredi&#39;</span><span class="p">,</span><span class="s1">&#39;Samedi&#39;</span><span class="p">],</span></div><div class='line' id='LC16'>		<span class="nx">dayNamesShort</span><span class="o">:</span> <span class="p">[</span><span class="s1">&#39;Dim.&#39;</span><span class="p">,</span><span class="s1">&#39;Lun.&#39;</span><span class="p">,</span><span class="s1">&#39;Mar.&#39;</span><span class="p">,</span><span class="s1">&#39;Mer.&#39;</span><span class="p">,</span><span class="s1">&#39;Jeu.&#39;</span><span class="p">,</span><span class="s1">&#39;Ven.&#39;</span><span class="p">,</span><span class="s1">&#39;Sam.&#39;</span><span class="p">],</span></div><div class='line' id='LC17'>		<span class="nx">dayNamesMin</span><span class="o">:</span> <span class="p">[</span><span class="s1">&#39;D&#39;</span><span class="p">,</span><span class="s1">&#39;L&#39;</span><span class="p">,</span><span class="s1">&#39;M&#39;</span><span class="p">,</span><span class="s1">&#39;M&#39;</span><span class="p">,</span><span class="s1">&#39;J&#39;</span><span class="p">,</span><span class="s1">&#39;V&#39;</span><span class="p">,</span><span class="s1">&#39;S&#39;</span><span class="p">],</span></div><div class='line' id='LC18'>		<span class="nx">weekHeader</span><span class="o">:</span> <span class="s1">&#39;Sem.&#39;</span><span class="p">,</span></div><div class='line' id='LC19'>		<span class="nx">dateFormat</span><span class="o">:</span> <span class="s1">&#39;dd/mm/yy&#39;</span><span class="p">,</span></div><div class='line' id='LC20'>		<span class="nx">firstDay</span><span class="o">:</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC21'>		<span class="nx">isRTL</span><span class="o">:</span> <span class="kc">false</span><span class="p">,</span></div><div class='line' id='LC22'>		<span class="nx">showMonthAfterYear</span><span class="o">:</span> <span class="kc">false</span><span class="p">,</span></div><div class='line' id='LC23'>		<span class="nx">yearSuffix</span><span class="o">:</span> <span class="s1">&#39;&#39;</span><span class="p">};</span></div><div class='line' id='LC24'>	<span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">setDefaults</span><span class="p">(</span><span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">regional</span><span class="p">[</span><span class="s1">&#39;fr&#39;</span><span class="p">]);</span></div><div class='line' id='LC25'><span class="p">});</span></div></pre></div>
          </td>
        </tr>
      </table>
  </div>

          </div>
        </div>

        <a href="#jump-to-line" rel="facebox" data-hotkey="l" class="js-jump-to-line" style="display:none">Jump to Line</a>
        <div id="jump-to-line" style="display:none">
          <h2>Jump to Line</h2>
          <form accept-charset="UTF-8" class="js-jump-to-line-form">
            <input class="textfield js-jump-to-line-field" type="text">
            <div class="full-button">
              <button type="submit" class="button">Go</button>
            </div>
          </form>
        </div>

      </div>
    </div>
</div>

<div id="js-frame-loading-template" class="frame frame-loading large-loading-area" style="display:none;">
  <img class="js-frame-loading-spinner" src="https://a248.e.akamai.net/assets.github.com/images/spinners/octocat-spinner-128.gif?1347543529" height="64" width="64">
</div>


        </div>
      </div>
      <div class="modal-backdrop"></div>
    </div>

      <div id="footer-push"></div><!-- hack for sticky footer -->
    </div><!-- end of wrapper - hack for sticky footer -->

      <!-- footer -->
      <div id="footer">
  <div class="container clearfix">

      <dl class="footer_nav">
        <dt>GitHub</dt>
        <dd><a href="https://github.com/about">About us</a></dd>
        <dd><a href="https://github.com/blog">Blog</a></dd>
        <dd><a href="https://github.com/contact">Contact &amp; support</a></dd>
        <dd><a href="http://enterprise.github.com/">GitHub Enterprise</a></dd>
        <dd><a href="http://status.github.com/">Site status</a></dd>
      </dl>

      <dl class="footer_nav">
        <dt>Applications</dt>
        <dd><a href="http://mac.github.com/">GitHub for Mac</a></dd>
        <dd><a href="http://windows.github.com/">GitHub for Windows</a></dd>
        <dd><a href="http://eclipse.github.com/">GitHub for Eclipse</a></dd>
        <dd><a href="http://mobile.github.com/">GitHub mobile apps</a></dd>
      </dl>

      <dl class="footer_nav">
        <dt>Services</dt>
        <dd><a href="http://get.gaug.es/">Gauges: Web analytics</a></dd>
        <dd><a href="http://speakerdeck.com">Speaker Deck: Presentations</a></dd>
        <dd><a href="https://gist.github.com">Gist: Code snippets</a></dd>
        <dd><a href="http://jobs.github.com/">Job board</a></dd>
      </dl>

      <dl class="footer_nav">
        <dt>Documentation</dt>
        <dd><a href="http://help.github.com/">GitHub Help</a></dd>
        <dd><a href="http://developer.github.com/">Developer API</a></dd>
        <dd><a href="http://github.github.com/github-flavored-markdown/">GitHub Flavored Markdown</a></dd>
        <dd><a href="http://pages.github.com/">GitHub Pages</a></dd>
      </dl>

      <dl class="footer_nav">
        <dt>More</dt>
        <dd><a href="http://training.github.com/">Training</a></dd>
        <dd><a href="https://github.com/edu">Students &amp; teachers</a></dd>
        <dd><a href="http://shop.github.com">The Shop</a></dd>
        <dd><a href="/plans">Plans &amp; pricing</a></dd>
        <dd><a href="http://octodex.github.com/">The Octodex</a></dd>
      </dl>

      <hr class="footer-divider">


    <p class="right">&copy; 2013 <span title="0.04671s from fe13.rs.github.com">GitHub</span>, Inc. All rights reserved.</p>
    <a class="left" href="https://github.com/">
      <span class="mega-icon mega-icon-invertocat"></span>
    </a>
    <ul id="legal">
        <li><a href="https://github.com/site/terms">Terms of Service</a></li>
        <li><a href="https://github.com/site/privacy">Privacy</a></li>
        <li><a href="https://github.com/security">Security</a></li>
    </ul>

  </div><!-- /.container -->

</div><!-- /.#footer -->


    <div class="fullscreen-overlay js-fullscreen-overlay" id="fullscreen_overlay">
  <div class="fullscreen-container js-fullscreen-container">
    <div class="textarea-wrap">
      <textarea name="fullscreen-contents" id="fullscreen-contents" class="js-fullscreen-contents" placeholder="" data-suggester="fullscreen_suggester"></textarea>
          <div class="suggester-container">
              <div class="suggester fullscreen-suggester js-navigation-container" id="fullscreen_suggester"
                 data-url="/jquery/jquery-ui/suggestions/commit">
              </div>
          </div>
    </div>
  </div>
  <div class="fullscreen-sidebar">
    <a href="#" class="exit-fullscreen js-exit-fullscreen tooltipped leftwards" title="Exit Zen Mode">
      <span class="mega-icon mega-icon-normalscreen"></span>
    </a>
    <a href="#" class="theme-switcher js-theme-switcher tooltipped leftwards"
      title="Switch themes">
      <span class="mini-icon mini-icon-brightness"></span>
    </a>
  </div>
</div>



    <div id="ajax-error-message" class="flash flash-error">
      <span class="mini-icon mini-icon-exclamation"></span>
      Something went wrong with that request. Please try again.
      <a href="#" class="mini-icon mini-icon-remove-close ajax-error-dismiss"></a>
    </div>

    
    
    <span id='server_response_time' data-time='0.04709' data-host='fe13'></span>
    
  </body>
</html>

