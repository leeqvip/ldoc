<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>接口文档</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <style type="text/css">
        {!!$css!!}
    </style>    
</head>

<body>
    <div id="container">
        <header id="header" class="wrapper">
            <div id="header-inner" class="inner">
                <h1 id="logo-wrap">                   
                    <span>接口文档</span>
                </h1>
                <nav id="main-nav">
                </nav>
                <div id="lang-select-wrap">
                    @if(!empty($versions))
                    <label id="lang-select-label"><i class="fa fa-globe"></i><span>{{$versions[$current_version]}}</span></label>
                    <select id="lang-select" data-canonical="">
                    @foreach($versions as $key => $version)
                        <option value="{{$key}}" @if($current_version == $key) selected @endif>{{$version}}</option>
                    @endforeach                        
                    </select>
                    @endif
                </div>
                <a id="mobile-nav-toggle">
                    <span class="mobile-nav-toggle-bar"></span>
                    <span class="mobile-nav-toggle-bar"></span>
                    <span class="mobile-nav-toggle-bar"></span>
                </a>
            </div>
        </header>
        <div id="content-wrap">
            <div id="content" class="wrapper">
                <div id="content-inner">
                    <article class="article-container" itemscope itemtype="http://schema.org/Article">
                        <div class="article-inner">
                            <div class="article">
                                <div class="inner">
                                    <!-- <header class="article-header">
                                        <h1 class="article-title" itemprop="name">--</h1>
                                    </header> -->
                                    <div class="article-content" itemprop="articleBody">
                                        {!! $content !!}
                                    </div>
                                    <footer class="article-footer">
                                        <!-- <time class="article-footer-updated" datetime="2019-03-26T07:54:33.316Z" itemprop="dateModified">上次更新：2019-03-26</time> -->
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </article>
                    <aside id="sidebar" role="navigation">
                        <div class="inner">
                            @foreach($sidebar as $key => $children)
                            <strong class="sidebar-title">{{$key}}</strong>
                            @foreach($children as $title => $child)
                            <a href="{{$base_path}}{{$child}}" class="sidebar-link @if($content_file_name == $child) current @endif">{{$title}}</a>
                            @endforeach
                            @endforeach
                        </div>
                    </aside>
                </div>
            </div>
        </div>
        <footer id="footer" class="wrapper">
            <div class="inner">
                <div id="footer-copyright">
                    &copy; 2019 Ldocs
                </div>
                <div id="footer-links">
                </div>
            </div>
        </footer>
    </div>

    <div id="mobile-nav-dimmer"></div>
  <nav id="mobile-nav">
  <div id="mobile-nav-inner">
    <!-- <ul id="mobile-nav-list">
      
      <li class="mobile-nav-item">
        <a href="https://github.com/" class="mobile-nav-link" rel="external" target="_blank">GitHub</a>
      </li>
    </ul> -->
    @foreach($sidebar as $key => $children)
    <strong class="mobile-nav-title">{{$key}}</strong>
    @foreach($children as $title => $child)
    <a href="{{$base_path}}{{$child}}" class="mobile-nav-link current">{{$title}}</a>
    @endforeach
    @endforeach
  </div>
  <div id="mobile-lang-select-wrap">

          @if(!empty($versions))          
    <span id="mobile-lang-select-label"><i class="fa fa-globe"></i><span>{{$versions[$current_version]}}</span></span>
    <select id="mobile-lang-select" data-canonical="">

    @foreach($versions as $key => $version)
    <option value="{{$key}}" @if($current_version == $key) selected @endif>{{$version}}</option>
        @endforeach  
      
    </select>
    @endif
  </div>
</nav>

    <script type="text/javascript">
    (function() {
  'use strict';


  function changeLang() {
    var lang = this.value;
    var canonical = this.dataset.canonical;
    var path = "{{$prefix_uri}}" ;
    if(lang != '{{$default_version_name}}') path += lang + '/';
    location.href = path + canonical;
  }

  document.getElementById('lang-select').addEventListener('change', changeLang);
  document.getElementById('mobile-lang-select').addEventListener('change', changeLang);
}());
(function() {
  'use strict';

  var body = document.getElementsByTagName('body')[0];
  var navToggle = document.getElementById('mobile-nav-toggle');
  var dimmer = document.getElementById('mobile-nav-dimmer');
  var CLASS_NAME = 'mobile-nav-on';
  if (!navToggle) return;

  navToggle.addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    body.classList.toggle(CLASS_NAME);
  });

  dimmer.addEventListener('click', function(e) {
    if (!body.classList.contains(CLASS_NAME)) return;

    e.preventDefault();
    body.classList.remove(CLASS_NAME);
  });
}());

    </script>
</body>

</html>