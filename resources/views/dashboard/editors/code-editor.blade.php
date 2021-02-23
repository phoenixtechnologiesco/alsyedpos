@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
      <div class="card">
        <div class="card-header">
          Code Editor - CodeMirror
          <div class="card-actions">
            <a href="http://codemirror.net" target="_blank">
              <small class="text-muted">docs</small>
            </a>
          </div>
        </div>
        <!-- Create code editor container -->
        <textarea id="codemirror">  &lt;!DOCTYPE html&gt;
            &lt;html lang="en"&gt;
            &lt;head&gt;

            &lt;meta charset="utf-8"&gt;
            &lt;meta http-equiv="X-UA-Compatible" content="IE=edge"&gt;
            &lt;meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"&gt;
            &lt;meta name="description" content=""&gt;
            &lt;meta name="author" content="Łukasz Holeczek"&gt;
            &lt;meta name="keyword" content=""&gt;
            &lt;link rel="shortcut icon" href="img/favicon.png"&gt;

            &lt;title&gt;&lt;/title&gt;

            &lt;!-- Icons --&gt;
            &lt;link href="vendors/css/font-awesome.min.css" rel="stylesheet"&gt;
            &lt;link href="vendors/css/simple-line-icons.min.css" rel="stylesheet"&gt;

            &lt;!-- Main styles for this application --&gt;
            &lt;link href="css/style.css" rel="stylesheet"&gt;

            &lt;/head&gt;


            &lt;body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden"&gt;
            &lt;header class="app-header navbar"&gt;
            ...
            &lt;/header&gt;
            &lt;div class="app-body"&gt;
            &lt;div class="sidebar"&gt;
            ...
            &lt;/div&gt;
            &lt;!-- Main content --&gt;
            &lt;main class="main"&gt;

            &lt;/main&gt;
            &lt;aside class="aside-menu"&gt;
            ...
            &lt;/aside&gt;
            &lt;/div&gt;
            &lt;footer class="app-footer"&gt;
            ...
            &lt;/footer&gt;

            &lt;!-- Bootstrap and necessary plugins --&gt;
            &lt;script src=&lt;script src="vendors/js/jquery.min.js"&gt;&lt;/script&gt;&gt;&lt;/div&gt;
            &lt;script src=&lt;script src="vendors/js/popper.min.js"&gt;&lt;/script&gt;&gt;&lt;/div&gt;
            &lt;script src=&lt;script src="vendors/js/bootstrap.min.js"&gt;&lt;/script&gt;&gt;&lt;/div&gt;
            &lt;script src=&lt;script src="vendors/js/pace.min.js"&gt;&lt;/script&gt;&gt;&lt;/div&gt;

            &lt;!-- Plugins and scripts required by all views --&gt;
            &lt;script src=&lt;script src="vendors/js/Chart.min.js"&gt;&lt;/script&gt;&gt;&lt;/div&gt;

            &lt;!-- Main scripts --&gt;
            &lt;script src="js/app-config.js"&gt;&lt;/div&gt;
            &lt;script src="js/app.js"&gt;&lt;/div&gt;

            &lt;/body&gt;
            &lt;/html&gt;
        </textarea>
      </div>
    </div>
</div>
@endsection

@section('javascript')
    <!-- Plugins and scripts required by this views -->
    <script src="{{ asset('js/coreui/min/codemirror.min.js') }}"></script>
    <script src="{{ asset('js/coreui/min/xml.min.js') }}"></script>

    <!-- Custom scripts required by this view -->
    <script src="{{ asset('js/coreui/code-editor.js') }}"></script>
@endsection