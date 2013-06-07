<div id="page" class="container">


	<!-- Masthead
	================================================== -->
	<header id="overview">
		<h1>Components</h1>
		<p class="lead">Dozens of reusable components are built into Diamond to provide navigation, alerts, popovers, and much more.</p>
		<div class="subnav">
			<ul class="nav nav-pills">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Navigation <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#navs">Nav, tabs, pills</a></li>
						<li><a href="#navbar">Navbar</a></li>
						<li><a href="#breadcrumbs">Breadcrumbs</a></li>
						<li><a href="#pagination">Pagination</a></li>
					</ul>
				</li>
				<li><a href="#labels">Labels</a></li>
				<li><a href="#badges">Badges</a></li>
				<li><a href="#typography">Typography</a></li>
				<li><a href="#thumbnails">Thumbnails</a></li>
				<li><a href="#alerts">Alerts</a></li>
				<li><a href="#progress">Progress bars</a></li>
				<li><a href="#avatar">Avatars</a></li>
				<li><a href="#discussion">Discussion</a></li>
				<li><a href="#misc">Miscellaneous</a></li>
			</ul>
		</div>
	</header>

	<!-- Nav, Tabs, & Pills
	================================================== -->
	<section id="navs">
		<div class="page-header">
			<h1>Nav, tabs, and pills <small>Highly customizable list-style navigation</small></h1>
		</div>

		<h2>Lightweight defaults <small>Same markup, different classes</small></h2>
		<div class="row">
			<div class="span4">
				<h3>Powerful base class</h3>
				<p>All nav components here&mdash;tabs, pills, and lists&mdash;<strong>share the same base markup and styles</strong> through the <code>.nav</code> class.</p>
				<h3>When to use</h3>
				<p>Tabs and pills are great for sections of content or navigating between pages of related content.</p>
				<h3>Component alignment</h3>
				<p>To align nav links, use the <code>.pull-left</code> or <code>.pull-right</code> utility classes. Both classes will add a CSS float in the specified direction.</p>
			</div>
			<div class="span8">
				<h3>Basic tabs</h3>
				<p>Take a regular <code>&lt;ul&gt;</code> of links and add <code>.nav-tabs</code>:</p>
				<div class="example">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#">Profile</a></li>
						<li><a href="#">Messages</a></li>
					</ul>
				</div>
				<pre class="prettyprint linenums">
&lt;ul class="nav nav-tabs"&gt;
  &lt;li class="active"&gt;
    &lt;a href="#"&gt;Home&lt;/a&gt;
  &lt;/li&gt;
  &lt;li&gt;&lt;a href="#"&gt;...&lt;/a&gt;&lt;/li&gt;
  &lt;li&gt;&lt;a href="#"&gt;...&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;</pre>
				<h3>Basic pills</h3>
				<p>Take that same HTML, but use <code>.nav-pills</code> instead:</p>
				<div class="example">
					<ul class="nav nav-pills">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#">Profile</a></li>
						<li><a href="#">Messages</a></li>
					</ul>
				</div>
				<pre class="prettyprint linenums">
&lt;ul class="nav nav-pills"&gt;
  &lt;li class="active"&gt;
    &lt;a href="#"&gt;Home&lt;/a&gt;
  &lt;/li&gt;
  &lt;li&gt;&lt;a href="#"&gt;...&lt;/a&gt;&lt;/li&gt;
  &lt;li&gt;&lt;a href="#"&gt;...&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;</pre>
			</div>
		</div>

		<h2>Stackable <small>Make tabs or pills vertical</small></h2>
		<div class="row">
			<div class="span4">
				<h3>How to stack 'em</h3>
				<p>As tabs and pills are horizontal by default, just add a second class, <code>.nav-stacked</code>, to make them appear vertically stacked.</p>
			</div>
			<div class="span8">
				<h3>Stacked tabs</h3>
				<div class="example">
					<ul class="nav nav-tabs nav-stacked">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#">Profile</a></li>
						<li><a href="#">Messages</a></li>
					</ul>
				</div>
				<pre class="prettyprint linenums">
&lt;ul class="nav nav-tabs nav-stacked"&gt;
  ...
&lt;/ul&gt;</pre>

				<h3>Stacked pills</h3>
				<div class="example">
					<ul class="nav nav-pills nav-stacked">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#">Profile</a></li>
						<li><a href="#">Messages</a></li>
					</ul>
				</div>
				<pre class="prettyprint linenums">
&lt;ul class="nav nav-pills nav-stacked"&gt;
  ...
&lt;/ul&gt;</pre>
			</div>
		</div>

		<h2>Dropdowns <small>For advanced nav components</small></h2>
		<div class="row">
			<div class="span4">
				<h3>Rich menus made easy</h3>
				<p>Dropdown menus in Diamond tabs and pills are super easy and require only a little extra HTML and a lightweight jQuery plugin.</p>
				<p>Head over to the Javascript page to read the docs on <a href="./javascript.html#tabs">initializing dropdowns</a> in Diamond.</p>
			</div>
			<div class="span8">
				<h3>Tabs with dropdowns</h3>
				<div class="example">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#">Help</a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Dropdown <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Dropup <b class="caret bottom-up"></b></a>
							<ul class="dropdown-menu bottom-up pull-right">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<pre class="prettyprint linenums">
&lt;ul class="nav nav-tabs"&gt;
  &lt;li class="dropdown"&gt;
    &lt;a class="dropdown-toggle"
       data-toggle="dropdown"
       href="#"&gt;
        Dropdown
        &lt;b class="caret"&gt;&lt;/b&gt;
      &lt;/a&gt;
    &lt;ul class="dropdown-menu"&gt;
      &lt;!-- links --&gt;
    &lt;/ul&gt;
  &lt;/li&gt;
&lt;/ul&gt;</pre>

				<h3>Pills with dropdowns</h3>
				<div class="example">
					<ul class="nav nav-pills">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#">Help</a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Dropdown <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Dropup <b class="caret bottom-up"></b></a>
							<ul class="dropdown-menu bottom-up pull-right">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<pre class="prettyprint linenums">
&lt;ul class="nav nav-pills"&gt;
  &lt;li class="dropdown"&gt;
    &lt;a class="dropdown-toggle"
       data-toggle="dropdown"
       href="#"&gt;
        Dropdown
        &lt;b class="caret"&gt;&lt;/b&gt;
      &lt;/a&gt;
    &lt;ul class="dropdown-menu"&gt;
      &lt;!-- links --&gt;
    &lt;/ul&gt;
  &lt;/li&gt;
&lt;/ul&gt;</pre>
			</div>
		</div>

		<h2>Nav lists <small>Build simple stacked navs, great for sidebars</small></h2>
		<div class="row">
			<div class="span4">
				<h3>Application-style navigation</h3>
				<p>Nav lists provide a simple and easy way to build groups of nav links with optional headers. They're best used in sidebars like the Finder in OS X.</p>
				<p>Structurally, they're built on the same core nav styles as tabs and pills, so usage and customization are straightforward.</p>
				<hr>
				<h4>With icons</h4>
				<p>Nav lists are also easy to equip with icons. Add the proper <code>&lt;i&gt;</code> tag with class and you're set.</p>
				<h4>Horizontal dividers</h4>
				<p>Add a horizontal divider by creating an empty list item with the class <code>.divider</code>, like so:</p>
				<pre class="prettyprint linenums">&lt;li class="divider"&gt;&lt;/li&gt;</pre>
			</div>
			<div class="span8">
				<h3>Example nav list</h3>
				<p>Take a list of links and add <code>class="nav nav-list"</code>:</p>
				<div class="example">
					<ul class="nav nav-list">
						<li class="nav-header">List header</li>
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#">Library</a></li>
						<li><a href="#">Applications</a></li>
						<li class="nav-header">Another list header</li>
						<li><a href="#">Profile</a></li>
						<li><a href="#">Settings</a></li>
						<li class="divider"></li>
						<li><a href="#">Help</a></li>
					</ul>
				</div> <!-- /well -->
				<pre class="prettyprint linenums">
&lt;ul class="nav nav-list"&gt;
  &lt;li class="nav-header"&gt;
    List header
  &lt;/li&gt;
  &lt;li class="active"&gt;
    &lt;a href="#"&gt;Home&lt;/a&gt;
  &lt;/li&gt;
  &lt;li&gt;
    &lt;a href="#"&gt;Library&lt;/a&gt;
  &lt;/li&gt;
  ...
&lt;/ul&gt;</pre>

				<h3>Example with icons</h3>
				<p>Same example, but with <code>&lt;i&gt;</code> tags for icons.</p>
				<div class="example">
					<ul class="nav nav-list">
						<li class="nav-header">List header</li>
						<li class="active"><a href="#"><i class="icon-white icon-home"></i> Home</a></li>
						<li><a href="#"><i class="icon-book"></i> Library</a></li>
						<li><a href="#"><i class="icon-pencil"></i> Applications</a></li>
						<li class="nav-header">Another list header</li>
						<li><a href="#"><i class="icon-user"></i> Profile</a></li>
						<li><a href="#"><i class="icon-cog"></i> Settings</a></li>
						<li class="divider"></li>
						<li><a href="#"><i class="icon-flag"></i> Help</a></li>
					</ul>
				</div> <!-- /well -->
				<pre class="prettyprint linenums">
&lt;ul class="nav nav-list"&gt;
  ...
  &lt;li&gt;
    &lt;a href="#"&gt;
      &lt;i class="icon-book"&gt;&lt;/i&gt;
      Library
    &lt;/a&gt;
  &lt;/li&gt;
  ...
&lt;/ul&gt;</pre>
			</div>
		</div>


		<h2>Tabbable nav <small>Bring tabs to life via javascript</small></h2>
		<div class="row">
			<div class="span4">
				<p>To make tabs tabbable, wrap the <code>.nav-tabs</code> in another div with class <code>.tabbable</code>.</p>

				<h3>What's included</h3>
				<p>Bring your tabs to life with a simple plugin to toggle between content via tabs. Diamond integrates tabbable tabs in four styles: top (default), right, bottom, and left.</p>

				<h3>Custom jQuery plugin</h3>
				<p>All tabbable tabs are powered by our lightweight jQuery plugin. Read more about how to bring tabbable tabs to life on the javascript docs page.</p>
				<p><a class="btn" href="./javascript.html#tabs">Get the javascript &rarr;</a></p>
				<p>Changing between them is easy and only requires changing very little markup.</p>
			</div>
			<div class="span8">
				<div class="example">
					<div class="tabbable" style="margin-bottom: 9px;">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#1" data-toggle="tab">Section 1</a></li>
							<li><a href="#2" data-toggle="tab">Section 2</a></li>
							<li><a href="#3" data-toggle="tab">Section 3</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="1">
								<p>I'm in Section 1.</p>
							</div>
							<div class="tab-pane" id="2">
								<p>Howdy, I'm in Section 2.</p>
							</div>
							<div class="tab-pane" id="3">
								<p>What up girl, this is Section 3.</p>
							</div>
						</div>
					</div> <!-- /tabbable -->
				</div>
				<pre class="prettyprint linenums">
&lt;div class="tabbable"&gt;
  &lt;ul class="nav nav-tabs"&gt;
    &lt;li class="active"&gt;&lt;a href="#1" data-toggle="tab"&gt;Section 1&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;&lt;a href="#2" data-toggle="tab"&gt;Section 2&lt;/a&gt;&lt;/li&gt;
  &lt;/ul&gt;
  &lt;div class="tab-content"&gt;
    &lt;div class="tab-pane active" id="1"&gt;
      &lt;p&gt;I'm in Section 1.&lt;/p&gt;
    &lt;/div&gt;
    &lt;div class="tab-pane" id="2"&gt;
      &lt;p&gt;Howdy, I'm in Section 2.&lt;/p&gt;
    &lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;</pre>
			</div>
		</div>

		<h3>Tabbable in any direction</h3>
		<div class="row">
			<div class="span4">
				<h4>Tabs on the bottom</h4>
				<p>Flip the order of the HTML and add a class to put tabs on the bottom.</p>
			</div>
			<div class="span8">
				<div class="example">
					<div class="tabbable tabs-below">
						<div class="tab-content">
							<div class="tab-pane active" id="A">
								<p>I'm in Section A.</p>
							</div>
							<div class="tab-pane" id="B">
								<p>Howdy, I'm in Section B.</p>
							</div>
							<div class="tab-pane" id="C">
								<p>What up girl, this is Section C.</p>
							</div>
						</div>
						<ul class="nav nav-tabs">
							<li class="active"><a href="#A" data-toggle="tab">Section 1</a></li>
							<li><a href="#B" data-toggle="tab">Section 2</a></li>
							<li><a href="#C" data-toggle="tab">Section 3</a></li>
						</ul>
					</div> <!-- /tabbable -->
				</div>
				<pre class="prettyprint linenums" style="margin-top: 11px;">
&lt;div class="tabbable tabs-below"&gt;
  &lt;div class="tab-content"&gt;
    ...
  &lt;/div&gt;
  &lt;ul class="nav nav-tabs"&gt;
    ...
  &lt;/ul&gt;
&lt;/div&gt;</pre>
			</div>
		</div>
		<div class="row">
			<div class="span4">
				<h4>Tabs on the left</h4>
				<p>Swap the class to put tabs on the left.</p>
			</div>
			<div class="span8">
				<div class="example">
					<div class="tabbable tabs-left">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#lA" data-toggle="tab">Section 1</a></li>
							<li><a href="#lB" data-toggle="tab">Section 2</a></li>
							<li><a href="#lC" data-toggle="tab">Section 3</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="lA">
								<p>I'm in Section A.</p>
							</div>
							<div class="tab-pane" id="lB">
								<p>Howdy, I'm in Section B.</p>
							</div>
							<div class="tab-pane" id="lC">
								<p>What up girl, this is Section C.</p>
							</div>
						</div>
					</div> <!-- /tabbable -->
				</div>
				<pre class="prettyprint linenums">
&lt;div class="tabbable tabs-left"&gt;
  &lt;ul class="nav nav-tabs"&gt;
    ...
  &lt;/ul&gt;
  &lt;div class="tab-content"&gt;
    ...
  &lt;/div&gt;
&lt;/div&gt;</pre>
			</div>
		</div>
		<div class="row">
			<div class="span4">
				<h4>Tabs on the right</h4>
				<p>Swap the class to put tabs on the right.</p>
			</div>
			<div class="span8">
				<div class="example">
					<div class="tabbable tabs-right">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#rA" data-toggle="tab">Section 1</a></li>
							<li><a href="#rB" data-toggle="tab">Section 2</a></li>
							<li><a href="#rC" data-toggle="tab">Section 3</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="rA">
								<p>I'm in Section A.</p>
							</div>
							<div class="tab-pane" id="rB">
								<p>Howdy, I'm in Section B.</p>
							</div>
							<div class="tab-pane" id="rC">
								<p>What up girl, this is Section C.</p>
							</div>
						</div>
					</div> <!-- /tabbable -->
				</div>
				<pre class="prettyprint linenums">
&lt;div class="tabbable tabs-right"&gt;
  &lt;ul class="nav nav-tabs"&gt;
    ...
  &lt;/ul&gt;
  &lt;div class="tab-content"&gt;
    ...
  &lt;/div&gt;
&lt;/div&gt;</pre>
			</div>
		</div>

	</section>



	<!-- Navbar
	================================================== -->
	<section id="navbar">
		<div class="page-header">
			<h1>Navbar</h1>
		</div>
		<div class="row">
			<div class="span12">
				<h2>Static navbar example</h2>
				<p>An example of a static (not fixed to the top) navbar with project name, navigation, and search form.</p>
				<div class="example">
					<div class="navbar">
						<div class="navbar-inner">
							<div class="container">
								<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</a>
								<a class="brand" href="#">Project name</a>
								<div class="nav-collapse">
									<ul class="nav">
										<li class="active"><a href="#">Home</a></li>
										<li><a href="#">Link</a></li>
										<li><a href="#">Link</a></li>
										<li><a href="#">Link</a></li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
											<ul class="dropdown-menu">
												<li><a href="#">Action</a></li>
												<li><a href="#">Another action</a></li>
												<li><a href="#">Something else here</a></li>
												<li class="divider"></li>
												<li class="nav-header">Nav header</li>
												<li><a href="#">Separated link</a></li>
												<li><a href="#">One more separated link</a></li>
											</ul>
										</li>
									</ul>
									<form class="navbar-search pull-left" action="">
										<input type="text" class="search-query span2" placeholder="Search">
									</form>
									<ul class="nav pull-right">
										<li><a href="#">Link</a></li>
										<li class="divider-vertical"></li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
											<ul class="dropdown-menu">
												<li><a href="#">Action</a></li>
												<li><a href="#">Another action</a></li>
												<li><a href="#">Something else here</a></li>
												<li class="divider"></li>
												<li><a href="#">Separated link</a></li>
											</ul>
										</li>
									</ul>
								</div><!-- /.nav-collapse -->
							</div>
						</div><!-- /navbar-inner -->
					</div><!-- /navbar -->
				</div>
				<pre class="prettyprint linenums">
&lt;div class="navbar"&gt;
  &lt;div class="navbar-inner"&gt;
    &lt;div class="container"&gt;
		...
    &lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;</pre>
			</div>
		</div>

		<h3>Fixed navbar</h3>
		<div class="row">
			<div class="span4">
				<p>Fix the navbar to the top or bottom of the viewport with an additional class on the outermost div, <code>.navbar</code>.</p>
			</div>
			<div class="span8">
				<pre class="prettyprint linenums">
&lt;div class="navbar navbar-fixed-top"&gt;
  ...
&lt;/div&gt;</pre>
				<pre class="prettyprint linenums">
&lt;div class="navbar navbar-fixed-bottom"&gt;
  ...
&lt;/div&gt;</pre>
			</div><!--/span-->
		</div><!--/row-->
		<p>When you affix the navbar, remember to account for the hidden area underneath. Add 40px or more of apdding to the <code>&lt;body&gt;</code>. Be sure to add this after the core Diamond CSS and before the optional responsive CSS.</p>

		<h3>Nav links</h3>
		<div class="row">
			<div class="span4">
				<p>Nav items are simple to add via unordered lists.</p>
			</div>
			<div class="span8">
				<pre class="prettyprint linenums">
&lt;ul class="nav"&gt;
  &lt;li class="active"&gt;
    &lt;a href="#">Home&lt;/a&gt;
  &lt;/li&gt;
  &lt;li&gt;&lt;a href="#"&gt;Link&lt;/a&gt;&lt;/li&gt;
  &lt;li&gt;&lt;a href="#"&gt;Link&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;</pre>

				<p>You can easily add dividers to your nav links with an empty list item and a simple class. Just add this between links:</p>
				<pre class="prettyprint linenums">
&lt;ul class="nav"&gt;
  ...
  &lt;li class="divider-vertical"&gt;&lt;/li&gt;
  ...
&lt;/ul&gt;</pre>
			</div>
		</div>

		<h3>Adding dropdown menus</h3>
		<div class="row">
			<div class="span4">
				<p>Adding dropdowns and dropups to the nav is super simple, but does require the use of <a href="./javascript.html/#dropdown">our javascript plugin</a>.</p>
				<p><a class="btn" href="./javascript.html#dropdowns">Get the javascript &rarr;</a></p>
			</div>
			<div class="span8">
				<pre class="prettyprint linenums">
&lt;ul class="nav"&gt;
  &lt;li class="dropdown"&gt;
    &lt;a href="#"
          class="dropdown-toggle"
          data-toggle="dropdown">
          Account
          &lt;b class="caret"&gt;&lt;/b&gt;
    &lt;/a&gt;
    &lt;ul class="dropdown-menu"&gt;
      ...
    &lt;/ul&gt;
  &lt;/li&gt;
&lt;/ul&gt;</pre>
			</div>
		</div>
		<div class="row">
			<div class="span6">
				<h3>Component alignment</h3>
				<p>To align a nav, search form, or text, use the <code>.pull-left</code> or <code>.pull-right</code> utility classes. Both classes will add a CSS float in the specified direction.</p>
			</div>
			<div class="span6">
				<h3>Text in the navbar</h3>
				<p>Wrap strings of text in a <code>&lt;p&gt;</code> tag for proper leading and color.</p>
			</div>
		</div>


		<h3>Brand name</h3>
		<div class="row">
			<div class="span4">
				<p>A simple link to show your brand or project name only requires an anchor tag.</p>
			</div>
			<div class="span8">
				<pre class="prettyprint linenums">
&lt;a class="brand" href="#"&gt;
  Project name
&lt;/a&gt;</pre>
			</div>
		</div>

		<h3>Forms in navbar</h3>
		<div class="row">
			<div class="span4">
				<p>To properly style and position a form within the navbar, add the appropriate classes as shown below. For a default form, include <code>.navbar-form</code> and either <code>.pull-left</code> or <code>.pull-right</code> to properly align it.</p>
			</div>
			<div class="span8">
				<pre class="prettyprint linenums">
&lt;form class="navbar-form pull-left"&gt;
  &lt;input type="text" class="span2"&gt;
&lt;/form&gt;</pre>
				<p>For a more customized search form, add the <code>.navbar-search</code> class to receive specialized styles in the navbar.</p>
				<pre class="prettyprint linenums">
&lt;form class="navbar-search pull-left"&gt;
  &lt;input type="text" class="search-query" placeholder="Search"&gt;
&lt;/form&gt;</pre>
			</div>
		</div>

		<h3>Optional responsive variation</h3>
		<div class="row">
			<div class="span4">
				<p>Depending on the amount of content in your topbar, you might want to implement the responsive options. To do so, wrap your nav content in a containing div, <code>.nav-collapse.collapse</code>, and add the navbar toggle button, <code>.btn-navbar</code>.</p>
			</div>
			<div class="span8">
				<pre class="prettyprint linenums">
&lt;div class="navbar"&gt;
  &lt;div class="navbar-inner"&gt;
    &lt;div class="container"&gt;

      &lt;!-- .btn-navbar is used as the toggle for collapsed navbar content --&gt;
      &lt;a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"&gt;
        &lt;span class="icon-bar"&gt;&lt;/span&gt;
        &lt;span class="icon-bar"&gt;&lt;/span&gt;
        &lt;span class="icon-bar"&gt;&lt;/span&gt;
      &lt;/a&gt;

      &lt;!-- Be sure to leave the brand out there if you want it shown --&gt;
      &lt;a class="brand" href="#"&gt;Project name&lt;/a&gt;

      &lt;!-- Everything you want hidden at 940px or less, place within here --&gt;
      &lt;div class="nav-collapse"&gt;
        &lt;!-- .nav, .navbar-search, .navbar-form, etc --&gt;
      &lt;/div&gt;

    &lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;</pre>
				<div class="alert alert-info">
					<strong>Heads up!</strong> The responsive navbar requires the <a href="./javascript.html#collapse">collapse plugin</a>.
				</div>
			</div>
		</div>
	</section>



	<!-- Breadcrumbs
	================================================== -->
	<section id="breadcrumbs">
		<div class="page-header">
			<h1>Breadcrumbs <small></small></h1>
		</div>

		<div class="row">
			<div class="span4">
				<h3>Why use them</h3>
				<p>Breadcrumb navigation is used as a way to show users where they are within an app or a site, but not for primary navigation. Keep their use sparse and succinct to be most effective.</p>
			</div>
			<div class="span8">
				<div class="example">
					<ul class="breadcrumb">
						<li class="active">Home</li>
					</ul>
					<ul class="breadcrumb">
						<li><a href="#">Home</a> <span class="divider">/</span></li>
						<li class="active">Library</li>
					</ul>
					<ul class="breadcrumb">
						<li><a href="#">Home</a> <span class="divider">/</span></li>
						<li><a href="#">Library</a> <span class="divider">/</span></li>
						<li class="active">Data</li>
					</ul>
				</div>
				<pre class="prettyprint linenums">
&lt;ul class="breadcrumb"&gt;
  &lt;li&gt;
    &lt;a href="#"&gt;Home&lt;/a&gt; &lt;span class="divider"&gt;/&lt;/span&gt;
  &lt;/li&gt;
  &lt;li&gt;
    &lt;a href="#"&gt;Library&lt;/a&gt; &lt;span class="divider"&gt;/&lt;/span&gt;
  &lt;/li&gt;
  &lt;li class="active"&gt;Data&lt;/li&gt;
&lt;/ul&gt;</pre>
			</div>
		</div>

	</section>



	<!-- Pagination
	================================================== -->
	<section id="pagination">
		<div class="page-header">
			<h1>Pagination <small>Two options for paging through content</small></h1>
		</div>

		<h2>Multicon-page pagination</h2>
		<div class="row">
			<div class="span4">
				<p>Ultra simplistic and minimally styled pagination inspired by Rdio, great for apps and search results. The large block is hard to miss, easily scalable, and provides large click areas.</p>
				<h3>Stateful page links</h3>
				<p>Links are customizable and work in a number of circumstances with the right class. <code>.disabled</code> for unclickable links and <code>.active</code> for current page.</p>
				<h3>Flexible alignment</h3>
				<p>Add either of two optional classes to change the alignment of pagination links: <code>.pagination-centered</code> and <code>.pagination-right</code>.</p>
			</div>
			<div class="span8">
				<div class="example">
					<div class="pagination">
						<ul>
							<li class="disabled"><a href="#">&laquo;</a></li>
							<li class="active"><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">&raquo;</a></li>
						</ul>
					</div>
					<div class="pagination">
						<ul>
							<li><a href="#">&laquo;</a></li>
							<li><a href="#">10</a></li>
							<li class="active"><a href="#">11</a></li>
							<li><a href="#">12</a></li>
							<li><a href="#">&raquo;</a></li>
						</ul>
					</div>
					<div class="pagination">
						<ul>
							<li><a href="#">&larr;</a></li>
							<li class="active"><a href="#">10</a></li>
							<li class="disabled"><a href="#">...</a></li>
							<li><a href="#">20</a></li>
							<li><a href="#">&rarr;</a></li>
						</ul>
					</div>
					<div class="pagination pagination-centered">
						<ul>
							<li class="active"><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
						</ul>
					</div>
				</div>
				<pre class="prettyprint linenums">
&lt;div class="pagination"&gt;
  &lt;ul&gt;
    &lt;li&gt;&lt;a href="#"&gt;Prev&lt;/a&gt;&lt;/li>
    &lt;li class="active"&gt;
      &lt;a href="#"&gt;1&lt;/a&gt;
    &lt;/li&gt;
    &lt;li&gt;&lt;a href="#"&gt;2&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;&lt;a href="#"&gt;3&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;&lt;a href="#"&gt;4&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;&lt;a href="#"&gt;Next&lt;/a&gt;&lt;/li>
  &lt;/ul&gt;
&lt;/div&gt;</pre>
			</div>
		</div><!-- /row -->

		<h2>Pager <small>For quick previous and next links</small></h2>
		<div class="row">
			<div class="span4">
				<p>The pager component is a set of links for simple pagination implementations with light markup and even lighter styles. It's great for simple sites like blogs or magazines.</p>
				<h4>Optional disabled state</h4>
				<p>Pager links also use the general <code>.disabled</code> class from the pagination.</p>
			</div>
			<div class="span8">
				<h3>Default example</h3>
				<p>By default, the pager centers links.</p>
				<div class="example">
					<ul class="pager">
						<li><a href="#">Previous</a></li>
						<li><a href="#">Next</a></li>
					</ul>
				</div>
				<pre class="prettyprint linenums">
&lt;ul class="pager"&gt;
  &lt;li&gt;
    &lt;a href="#"&gt;Previous&lt;/a&gt;
  &lt;/li&gt;
  &lt;li&gt;
    &lt;a href="#"&gt;Next&lt;/a&gt;
  &lt;/li&gt;
&lt;/ul&gt;</pre>
			</div>
		</div>

		<h3>Aligned links</h3>
		<div class="row">
			<div class="span4">
				<p>Alternatively, you can align each link to the sides:</p>
				<div class="example">
					<ul class="pager">
						<li class="previous"><a href="#">&larr; Older</a></li>
						<li class="next"><a href="#">Newer &rarr;</a></li>
					</ul>
				</div>
				<pre class="prettyprint linenums">
&lt;ul class="pager"&gt;
  &lt;li class="previous"&gt;
    &lt;a href="#"&gt;&amp;larr; Older&lt;/a&gt;
  &lt;/li&gt;
  &lt;li class="next"&gt;
    &lt;a href="#"&gt;Newer &amp;rarr;&lt;/a&gt;
  &lt;/li&gt;
&lt;/ul&gt;</pre>
			</div>
		</div><!-- /row -->
	</section>



	<!-- Labels
	================================================== -->
	<section id="labels">
		<div class="page-header">
			<h1>Inline labels <small>Label and annotate text</small></h1>
		</div>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Labels</th>
					<th>Markup</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<span class="label">Default</span>
					</td>
					<td>
						<code>&lt;span class="label"&gt;Default&lt;/span&gt;</code>
					</td>
				</tr>
				<tr>
					<td>
						<span class="label label-success">Success</span>
					</td>
					<td>
						<code>&lt;span class="label label-success"&gt;Success&lt;/span&gt;</code>
					</td>
				</tr>
				<tr>
					<td>
						<span class="label label-warning">Warning</span>
					</td>
					<td>
						<code>&lt;span class="label label-warning"&gt;Warning&lt;/span&gt;</code>
					</td>
				</tr>
				<tr>
					<td>
						<span class="label label-important">Important</span>
					</td>
					<td>
						<code>&lt;span class="label label-important"&gt;Important&lt;/span&gt;</code>
					</td>
				</tr>
				<tr>
					<td>
						<span class="label label-info">Info</span>
					</td>
					<td>
						<code>&lt;span class="label label-info"&gt;Info&lt;/span&gt;</code>
					</td>
				</tr>
				<tr>
					<td>
						<span class="label label-inverse">Inverse</span>
					</td>
					<td>
						<code>&lt;span class="label label-inverse"&gt;Inverse&lt;/span&gt;</code>
					</td>
				</tr>
			</tbody>
		</table>
	</section>



	<!-- Badges
	================================================== -->
	<section id="badges">
		<div class="page-header">
			<h1>Badges <small>Indicators and unread counts</small></h1>
		</div>
		<div class="row">
			<div class="span4">
				<p>Badges are small, simple components for displaying an indicator or count of some sort. They're commonly found in email clients like Mail.app or on mobile apps for push notifications.</p>
			</div><!-- /.span -->
			<div class="span8">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Name</th>
							<th>Example</th>
							<th>Markup</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								Default
							</td>
							<td>
								<span class="badge">1</span>
							</td>
							<td>
								<code>&lt;span class="badge"&gt;1&lt;/span&gt;</code>
							</td>
						</tr>
						<tr>
							<td>
								Success
							</td>
							<td>
								<span class="badge badge-success">2</span>
							</td>
							<td>
								<code>&lt;span class="badge badge-success"&gt;2&lt;/span&gt;</code>
							</td>
						</tr>
						<tr>
							<td>
								Warning
							</td>
							<td>
								<span class="badge badge-warning">4</span>
							</td>
							<td>
								<code>&lt;span class="badge badge-warning"&gt;4&lt;/span&gt;</code>
							</td>
						</tr>
						<tr>
							<td>
								Error
							</td>
							<td>
								<span class="badge badge-error">6</span>
							</td>
							<td>
								<code>&lt;span class="badge badge-error"&gt;6&lt;/span&gt;</code>
							</td>
						</tr>
						<tr>
							<td>
								Info
							</td>
							<td>
								<span class="badge badge-info">8</span>
							</td>
							<td>
								<code>&lt;span class="badge badge-info"&gt;8&lt;/span&gt;</code>
							</td>
						</tr>
						<tr>
							<td>
								Inverse
							</td>
							<td>
								<span class="badge badge-inverse">10</span>
							</td>
							<td>
								<code>&lt;span class="badge badge-inverse"&gt;10&lt;/span&gt;</code>
							</td>
						</tr>
					</tbody>
				</table>
			</div><!-- /.span -->
		</div><!-- /.row -->
	</section>



	<!-- Typographic components
	================================================== -->
	<section id="typography">
		<div class="page-header">
			<h1>Typographic components <small>Page header and hero unit for segmenting content</small></h1>
		</div>
		<h2>Hero unit</h2>
		<div class="row">
			<div class="span4">
				<p>Diamond provides a lightweight, flexible component called a hero unit to showcase content on your site. It works well on marketing and content-heavy sites.</p>
			</div>
			<div class="span8">
				<div class="example">
					<div class="hero-unit">
						<h1>Hello, world!</h1>
						<p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
						<p><a class="btn btn-primary btn-large">Learn more</a></p>
					</div>
				</div>
				<pre class="prettyprint linenums">
&lt;div class="hero-unit"&gt;
  &lt;h1&gt;Heading&lt;/h1&gt;
  &lt;p&gt;Tagline&lt;/p&gt;
  &lt;p&gt;
    &lt;a class="btn btn-primary btn-large"&gt;
      Learn more
    &lt;/a&gt;
  &lt;/p&gt;
&lt;/div&gt;</pre>
			</div>
		</div><!-- /row -->
		<h2>Page header</h2>
		<div class="row">
			<div class="span4">
				<p>A simple shell for an <code>h1</code> to appropratiely space out and segment sections of content on a page. It can utilize the <code>h1</code>'s default <code>small</code>, element as well most other components (with additional styles).</p>
			</div>
			<div class="span8">
				<div class="example">
					<div class="page-header">
						<h1>Example page header <small>Subtext for header</small></h1>
					</div>
				</div>
				<pre class="prettyprint linenums">
&lt;div class="page-header"&gt;
  &lt;h1&gt;... &lt;small&gt;...&lt;/small&gt;&lt;/h1&gt;
&lt;/div&gt;</pre>
			</div>
		</div><!-- /row -->
	</section>



	<!-- Thumbnails
	================================================== -->
	<section id="thumbnails">
		<div class="page-header">
			<h1>Thumbnails <small>Grids of images, videos, text, and more</small></h1>
		</div>

		<div class="row">
			<div class="span4">
				<h2>Default thumbnails</h2>
				<p>By default, Diamond's thumbnails are designed to showcase linked images with minimal required markup.</p>
			</div>
			<div class="span8">
				<div class="example">
					<ul class="thumbnails">
						<li class="span3">
							<a href="#" class="thumbnail">
								<img src="http://placehold.it/260x180" alt="">
							</a>
						</li>
						<li class="span3">
							<a href="#" class="thumbnail">
								<img src="http://placehold.it/260x180" alt="">
							</a>
						</li>
						<li class="span3">
							<a href="#" class="thumbnail">
								<img src="http://placehold.it/260x180" alt="">
							</a>
						</li>
						<li class="span3">
							<a href="#" class="thumbnail">
								<img src="http://placehold.it/260x180" alt="">
							</a>
						</li>
					</ul>
				</div>
				<pre class="prettyprint linenums">
&lt;ul class="thumbnails"&gt;
  &lt;li class="span3"&gt;
    &lt;a href="#" class="thumbnail"&gt;
      &lt;img src="http://placehold.it/260x180" alt=""&gt;
    &lt;/a&gt;
  &lt;/li&gt;
  ...
&lt;/ul&gt;</pre>
			</div>
		</div>
		<div class="row">
			<div class="span4">
				<h2>Highly customizable</h2>
				<p>With a bit of extra markup, it's possible to add any kind of HTML content like headings, paragraphs, or buttons into thumbnails.</p>
			</div>
			<div class="span8">
				<div class="example">
					<ul class="thumbnails">
						<li class="span3">
							<div class="thumbnail">
								<img src="http://placehold.it/260x180" alt="">
								<div class="caption">
									<h5>Thumbnail label</h5>
									<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
									<p><a href="#" class="btn btn-primary">Action</a> <a href="#" class="btn">Action</a></p>
								</div>
							</div>
						</li>
						<li class="span3">
							<div class="thumbnail">
								<img src="http://placehold.it/260x180" alt="">
								<div class="caption">
									<h5>Thumbnail label</h5>
									<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
									<p><a href="#" class="btn btn-primary">Action</a> <a href="#" class="btn">Action</a></p>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<pre class="prettyprint linenums">
&lt;ul class="thumbnails"&gt;
  &lt;li class="span3"&gt;
    &lt;div class="thumbnail"&gt;
      &lt;img src="http://placehold.it/260x180" alt=""&gt;
      &lt;h5&gt;Thumbnail label&lt;/h5&gt;
      &lt;p&gt;Thumbnail caption right here...&lt;/p&gt;
    &lt;/div&gt;
  &lt;/li&gt;
  ...
&lt;/ul&gt;</pre>
			</div>
		</div>

		<div class="row">
			<div class="span4">
				<h3>Why use thumbnails</h3>
				<p>Thumbnails (previously <code>.media-grid</code> up until v1.4) are great for grids of photos or videos, image search results, retail products, portfolios, and much more. They can be links or static content.</p>
			</div>
			<div class="span4">
				<h3>Simple, flexible markup</h3>
				<p>Thumbnail markup is simple&mdash;a <code>ul</code> with any number of <code>li</code> elements is all that is required. It's also super flexible, allowing for any type of content with just a bit more markup to wrap your contents.</p>
			</div>
			<div class="span4">
				<h3>Uses grid column sizes</h3>
				<p>Lastly, the thumbnails component uses existing grid system classes&mdash;like <code>.span2</code> or <code>.span3</code>&mdash;for control of thumbnail dimensions.</p>
			</div>
		</div>
	</section>



	<!-- Alerts & Messages
	================================================== -->
	<section id="alerts">
		<div class="page-header">
			<h1>Alerts <small>Styles for success, warning, and error messages</small></h1>
		</div>

		<h2>Lightweight defaults</h2>
		<div class="row">
			<div class="span4">
				<h3>Single alert message</h3>
				<p>For a more durable component with less code, we've removed the differentiating look for block alerts, messages that come with more padding and typically more text. The class also has changed to <code>.alert-block</code>.</p>
				<hr>
				<h3>Goes great with javascript</h3>
				<p>Diamond comes with a great jQuery plugin that supports alert messages, making dismissing them quick and easy.</p>
				<p><a class="btn js-btn" href="./javascript.html#alerts">Get the plugin &raquo;</a></p>
			</div>
			<div class="span8">
				<div class="example">
					<div class="alert">
						<a class="close" data-dismiss="alert"></a>
						<strong>Warning!</strong> Best check yo self, you're not looking too good.
					</div>
				</div>
				<pre class="prettyprint linenums">
&lt;div class="alert"&gt;
  &lt;a class="close" data-dismiss="alert"&gt;&lt;/a&gt;
  &lt;strong&gt;Warning!&lt;/strong&gt; Best check yo self, you're not looking too good.
&lt;/div&gt;</pre>
				<p>Easily extend the standard alert message with two optional classes: <code>.alert-block</code> for more padding and text controls and <code>.alert-heading</code> for a matching heading.</p>
				<div class="example">
					<div class="alert alert-block">
						<a class="close" data-dismiss="alert"></a>
						<h4 class="alert-heading">Warning!</h4>
						<p>Best check yo self, you're not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
					</div>
				</div>
				<pre class="prettyprint linenums">
&lt;div class="alert alert-block"&gt;
  &lt;a class="close" data-dismiss="alert"&gt;&lt;/a&gt;
  &lt;h4 class="alert-heading"&gt;Warning!&lt;/h4&gt;
  Best check yo self, you're not...
&lt;/div&gt;</pre>
			</div>
		</div>

		<h2>Contextual alternatives <small>Add optional classes to change an alert's connotation</small></h2>
		<div class="row">
			<div class="span4">
				<h3>Error or danger</h3>
				<div class="example">
					<div class="alert alert-error">
						<a class="close" data-dismiss="alert"></a>
						<strong>Oh snap!</strong> Change a few things up and try submitting again.
					</div>
				</div>
				<pre class="prettyprint linenums">
&lt;div class="alert alert-error"&gt;
  ...
&lt;/div&gt;</pre>
			</div>
			<div class="span4">
				<h3>Success</h3>
				<div class="example">
					<div class="alert alert-success">
						<a class="close" data-dismiss="alert"></a>
						<strong>Well done!</strong> You successfully read this important alert message.
					</div>
				</div>
				<pre class="prettyprint linenums">
&lt;div class="alert alert-success"&gt;
  ...
&lt;/div&gt;</pre>
			</div>
			<div class="span4">
				<h3>Information</h3>
				<div class="example">
					<div class="alert alert-info">
						<a class="close" data-dismiss="alert"></a>
						<strong>Heads up!</strong> This alert needs your attention, but it's not super important.
					</div>
				</div>
				<pre class="prettyprint linenums">
&lt;div class="alert alert-info"&gt;
  ...
&lt;/div&gt;</pre>
			</div>
		</div>

	</section>



	<!-- Progress bars
	================================================== -->
	<section id="progress">
		<div class="page-header">
			<h1>Progress bars <small>For loading, redirecting, or action status</small></h1>
		</div>
		<div class="row">
			<div class="span4">
				<h3>Basic</h3>
				<p>Default progress bar with a vertical gradient.</p>
				<div class="example">
					<div class="progress">
						<div class="bar" style="width: 60%;"></div>
					</div>
				</div>
				<pre class="prettyprint linenums">
&lt;div class="progress"&gt;
  &lt;div class="bar"
       style="width: 60%;"&gt;&lt;/div&gt;
&lt;/div&gt;</pre>
			</div>
			<div class="span4">
				<h3>Striped</h3>
				<p>Uses a gradient to create a striped effect (no IE).</p>
				<div class="example">
					<div class="progress progress-striped">
						<div class="bar" style="width: 20%;"></div>
					</div>
				</div>
				<pre class="prettyprint linenums">
&lt;div class="progress progress-striped"&gt;
  &lt;div class="bar"
       style="width: 20%;"&gt;&lt;/div&gt;
&lt;/div&gt;</pre>
			</div>
			<div class="span4">
				<h3>Animated</h3>
				<p>Takes the striped example and animates it (no IE).</p>
				<div class="example">
					<div class="progress progress-striped active">
						<div class="bar" style="width: 45%"></div>
					</div>
				</div>
				<pre class="prettyprint linenums">
&lt;div class="progress progress-striped
     active"&gt;
  &lt;div class="bar"
       style="width: 40%;"&gt;&lt;/div&gt;
&lt;/div&gt;</pre>
			</div>
		</div>

		<h2>Options and browser support</h2>
		<h3>Additional colors</h3>
		<div class="row">
			<div class="span4">
				<p>Progress bars use some of the same button and alert classes for consistent styles.</p>
			</div>
			<div class="span8">
				<div class="example">
					<div class="progress progress-info" style="margin-bottom: 9px;">
						<div class="bar" style="width: 20%"></div>
					</div>
					<div class="progress progress-success" style="margin-bottom: 9px;">
						<div class="bar" style="width: 40%"></div>
					</div>
					<div class="progress progress-warning" style="margin-bottom: 9px;">
						<div class="bar" style="width: 60%"></div>
					</div>
					<div class="progress progress-danger" style="margin-bottom: 9px;">
						<div class="bar" style="width: 80%"></div>
					</div>
				</div>
			</div>
		</div>

		<h3>Striped bars</h3>
		<div class="row">
			<div class="span4">
				<p>Similar to the solid colors, we have varied striped progress bars.</p>
			</div>
			<div class="span8">
				<div class="example">
					<div class="progress progress-info progress-striped" style="margin-bottom: 9px;">
						<div class="bar" style="width: 20%"></div>
					</div>
					<div class="progress progress-success progress-striped" style="margin-bottom: 9px;">
						<div class="bar" style="width: 40%"></div>
					</div>
					<div class="progress progress-warning progress-striped" style="margin-bottom: 9px;">
						<div class="bar" style="width: 60%"></div>
					</div>
					<div class="progress progress-danger progress-striped" style="margin-bottom: 9px;">
						<div class="bar" style="width: 80%"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span6">
				<h3>Behavior</h3>
				<p>Progress bars use CSS3 transitions, so if you dynamically adjust the width via javascript, it will smoothly resize.</p>
				<p>If you use the <code>.active</code> class, your <code>.progress-striped</code> progress bars will animate the stripes left to right.</p>
			</div>
			<div class="span6">
				<h3>Browser support</h3>
				<p>Progress bars use CSS3 gradients, transitions, and animations to achieve all their effects. These features are not supported in IE7-9 or older versions of Firefox.</p>
				<p>Opera and IE do not support animations at this time.</p>
			</div>
		</div>

	</section>





	<!-- Avatar
	================================================== -->
	<section id="avatar">
		<div class="page-header">
			<h1>Avatar</h1>
		</div>
		<div class="row">
			<div class="span6">
				<div class="example">
					<div class="avatar avatar-medium">
						<div class="avatar-inner">
							<i class="icon-user"></i>
						</div>
					</div>
				</div>
				<pre class="prettyprint linenums">
&lt;div class="avatar avatar-medium"&gt;
  &lt;div class="avatar-inner"&gt;
    &lt;div class="avatar avatar-medium"&gt;
      &lt;img src="..." alt="" /&gt;
    &lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;

&lt;div class="avatar avatar-medium"&gt;
  &lt;div class="avatar-inner"&gt;
    &lt;div class="avatar avatar-medium"&gt;
      &lt;i class="icon-user"&gt;&lt;/i&gt;
    &lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;</pre>
			</div><!--/span-->
			<div class="span6">
				<h2>Rounded avatar</h2>
				<p>By adding the class <code>.avatar-rounded</code> to the parent, you create a circle-like avatar.</p>
				<div class="avatar avatar-large avatar-rounded">
					<div class="avatar-inner">
						<i class="icon-user"></i>
					</div>
				</div>
			</div>
		</div><!--/row-->
		<div class="row">
			<div class="span6">
				<h2>Other colors</h2>
				<p>By adding a color class to the parent, you change the background and border color of the avatar.</p>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Example</th>
							<th>Color</th>
							<th>Class</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="avatar avatar-medium avatar-primary">
									<div class="avatar-inner">
										<i class="icon-user"></i>
									</div>
								</div>
							</td>
							<td>Blue</td>
							<td><code>.avatar-primary</code></td>
						</tr>
						<tr>
							<td>
								<div class="avatar avatar-medium avatar-info">
									<div class="avatar-inner">
										<i class="icon-user"></i>
									</div>
								</div>
							</td>
							<td>Purple</td>
							<td><code>.avatar-info</code></td>
						</tr>
						<tr>
							<td>
								<div class="avatar avatar-medium avatar-success">
									<div class="avatar-inner">
										<i class="icon-user"></i>
									</div>
								</div>
							</td>
							<td>Green</td>
							<td><code>.avatar-success</code></td>
						</tr>
						<tr>
							<td>
								<div class="avatar avatar-medium avatar-warning">
									<div class="avatar-inner">
										<i class="icon-user"></i>
									</div>
								</div>
							</td>
							<td>Orange</td>
							<td><code>.avatar-warning</code></td>
						</tr>
						<tr>
							<td>
								<div class="avatar avatar-medium avatar-danger">
									<div class="avatar-inner">
										<i class="icon-user"></i>
									</div>
								</div>
							</td>
							<td>Red</td>
							<td><code>.avatar-danger</code></td>
						</tr>
						<tr>
							<td>
								<div class="avatar avatar-medium avatar-inverse">
									<div class="avatar-inner">
										<i class="icon-user"></i>
									</div>
								</div>
							</td>
							<td>Dark gray</td>
							<td><code>.avatar-inverse</code></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="span6">
				<h2>Sizes</h2>
				<p>By adding a size class to the parent, you change the size of the avatar.</p>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Example</th>
							<th>Size</th>
							<th>Class</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="avatar avatar-xsmall">
									<div class="avatar-inner">
										<i class="icon-user"></i>
									</div>
								</div>
							</td>
							<td>16px</td>
							<td><code>.avatar-xsmall</code></td>
						</tr>
						<tr>
							<td>
								<div class="avatar avatar-small">
									<div class="avatar-inner">
										<i class="icon-user"></i>
									</div>
								</div>
							</td>
							<td>24px</td>
							<td><code>.avatar-small</code></td>
						</tr>
						<tr>
							<td>
								<div class="avatar avatar-medium">
									<div class="avatar-inner">
										<i class="icon-user"></i>
									</div>
								</div>
							</td>
							<td>32px</td>
							<td><code>.avatar-medium</code></td>
						</tr>
						<tr>
							<td>
								<div class="avatar avatar-large">
									<div class="avatar-inner">
										<i class="icon-user"></i>
									</div>
								</div>
							</td>
							<td>48px</td>
							<td><code>.avatar-large</code></td>
						</tr>
						<tr>
							<td>
								<div class="avatar avatar-xlarge">
									<div class="avatar-inner">
										<i class="icon-user"></i>
									</div>
								</div>
							</td>
							<td>96px</td>
							<td><code>.avatar-xlarge</code></td>
						</tr>
					</tbody>
				</table>
			</div><!--/span-->
		</div>
	</section>






	<!-- Discussion
	================================================== -->
	<section id="discussion">
		<div class="page-header">
			<h1>Discussion</h1>
		</div>
		<div class="row">
			<div class="span4">
				<h2>Default</h2>
				<p>A avatar with a speechbubble to use in fora, comments or discussions</p>
			</div>
			<div class="span8">
				<div class="example">
					<div class="discussion-bubble">
						<div class="avatar avatar-medium">
							<div class="avatar-inner">
								<i class="icon-user"></i>
							</div>
						</div>
						<div class="discussion-content">
							<div class="discussion-inner">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis nulla dolor, nec mattis dui. Nunc sem magna, cursus ut luctus quis, rhoncus in libero. Vestibulum et tempor purus.</p>
							</div>
						</div>
					</div>					
				</div>
				<pre class="prettyprint linenums">
&lt;div class="discussion-bubble"&gt;
	&lt;div class="avatar avatar-medium"&gt;
		&lt;div class="avatar-inner"&gt;
			&lt;i class="icon-user"&gt;&lt;/i&gt;
		&lt;/div&gt;
	&lt;/div&gt;
	&lt;div class="discussion-content"&gt;
		&lt;div class="discussion-inner"&gt;
			...
		&lt;/div&gt;
	&lt;/div&gt;
&lt;/div&gt;</pre>
			</div>
		</div><!--/row-->

		<div class="row">
			<div class="span4">
				<h2>Mini discussion</h2>
				<p>Add the class <code>.mini-discussion</code> to the main container.</p>
				<p>Here you can also add a container with class <code>.discussion-header</code> too include some basic information. Add the container just between the avatar and the content.</p>
			</div>
			<div class="span8">
				<div class="example">
					<div class="discussion-bubble mini-discussion">
						<div class="avatar avatar-medium">
							<div class="avatar-inner">
								<i class="icon-user"></i>
							</div>
						</div>
						<div class="discussion-header">
							<a href="#">defunkt</a> started a discussion in the diff 
							<span class="pull-right"><time>6 days ago</time></span>
						</div>							
						<div class="discussion-content">
							<div class="discussion-inner">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis nulla dolor, nec mattis dui. Nunc sem magna, cursus ut luctus quis, rhoncus in libero. Vestibulum et tempor purus.</p>
							</div>
						</div>
					</div>					
				</div>
				<pre class="prettyprint linenums">
&lt;div class="discussion-bubble mini-discussion"&gt;
	&lt;div class="avatar avatar-medium"&gt;
		&lt;div class="avatar-inner"&gt;
			&lt;i class="icon-user"&gt;&lt;/i&gt;
		&lt;/div&gt;
	&lt;/div&gt;
	&lt;div class="discussion-header"&gt; 
		...
	&lt;/div&gt;
	&lt;div class="discussion-content"&gt;
		&lt;div class="discussion-inner"&gt;
			...
		&lt;/div&gt;
	&lt;/div&gt;
&lt;/div&gt;</pre>
			</div>
		</div><!--/row-->

		<div class="row">
			<div class="span4">
				<p>Or include the header container inside the <code>.discussion-content</code> container.</p>
			</div>
			<div class="span8">
				<div class="example">
					<div class="discussion-bubble">
						<div class="avatar avatar-medium">
							<div class="avatar-inner">
								<i class="icon-user"></i>
							</div>
						</div>
						<div class="discussion-content">
							<div class="discussion-header">
								<a href="#">defunkt</a> started a discussion in the diff 
								<span class="pull-right"><time>6 days ago</time></span>
							</div>							
							<div class="discussion-inner">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis nulla dolor, nec mattis dui. Nunc sem magna, cursus ut luctus quis, rhoncus in libero. Vestibulum et tempor purus.</p>
							</div>
						</div>
					</div>					
				</div>
				<pre class="prettyprint linenums">
&lt;div class="discussion-bubble"&gt;
	&lt;div class="avatar avatar-medium"&gt;
		&lt;div class="avatar-inner"&gt;
			&lt;i class="icon-user"&gt;&lt;/i&gt;
		&lt;/div&gt;
	&lt;/div&gt;
	&lt;div class="discussion-content"&gt;
		&lt;div class="discussion-header"&gt; 
			...
		&lt;/div&gt;
		&lt;div class="discussion-inner"&gt;
			...
		&lt;/div&gt;
	&lt;/div&gt;
&lt;/div&gt;</pre>
			</div>
		</div><!--/row-->

	</section>




	<!-- Miscellaneous
	================================================== -->
	<section id="misc">
		<div class="page-header">
			<h1>Miscellaneous <small>Lightweight utility components</small></h1>
		</div>

		<h2>Wells</h2>
		<div class="row">
			<div class="span4">
				<p>Use the well as a simple effect on an element to give it an inset effect.</p>
			</div>
			<div class="span8">
				<div class="example">
					<div class="well">
						Look, I'm in a well!
					</div>
				</div>
				<pre class="prettyprint linenums">
&lt;div class="well"&gt;
  ...
&lt;/div&gt;</pre>
			</div><!--/span-->
		</div>

		<h2>Close icon</h2>
		<div class="row">
			<div class="span4">
				<p>Use the generic close icon for dismissing content like modals and alerts.</p>
			</div>
			<div class="span8">
				<div class="example">
					<p><a class="close" style="float: none;"></a></p>
				</div>
				<pre class="prettyprint linenums">&lt;a class="close"&gt;&lt;/a&gt;</pre>
			</div><!--/span-->
		</div><!--/row-->
	</section>




</div><!--/page-->

<?php $this->load->view('diamond/footer'); ?>
