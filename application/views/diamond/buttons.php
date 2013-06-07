<div id="page" class="container">


	<!-- Masthead
	================================================== -->
	<header id="overview">
		<h1>Buttons</h1>
		<div class="subnav">
			<ul class="nav nav-pills">
				<li><a href="#buttonstyles">Button styles</a></li>
				<li><a href="#buttonGroups">Button groups</a></li>
				<li><a href="#buttonDropdowns">Button dropdowns</a></li>
				<li><a href="#social-count-button">Social Count button</a></li>
			</ul>
		</div>
	</header>


	<!-- Buttons Styles
	================================================== -->
	<section id="buttonstyles">
		<div class="page-header">
			<h1>Button styles</h1>
		</div>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Button</th>
					<th>class=""</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><button class="btn" href="#">Default</button></td>
					<td><code>btn</code></td>
					<td>Standard gray button with gradient</td>
				</tr>
				<tr>
					<td><button class="btn btn-primary" href="#">Primary</button></td>
					<td><code>btn btn-primary</code></td>
					<td>Provides extra visual weight and identifies the primary action in a set of buttons</td>
				</tr>
				<tr>
					<td><button class="btn btn-info" href="#">Info</button></td>
					<td><code>btn btn-info</code></td>
					<td>Used as an alternate to the default styles</td>
				</tr>
				<tr>
					<td><button class="btn btn-success" href="#">Success</button></td>
					<td><code>btn btn-success</code></td>
					<td>Indicates a successful or positive action</td>
				</tr>
				<tr>
					<td><button class="btn btn-warning" href="#">Warning</button></td>
					<td><code>btn btn-warning</code></td>
					<td>Indicates caution should be taken with this action</td>
				</tr>
				<tr>
					<td><button class="btn btn-danger" href="#">Danger</button></td>
					<td><code>btn btn-danger</code></td>
					<td>Indicates a dangerous or potentially negative action</td>
				</tr>
				<tr>
					<td><button class="btn btn-inverse" href="#">Inverse</button></td>
					<td><code>btn btn-inverse</code></td>
					<td>Alternate dark gray button, not tied to a semantic action or use</td>
				</tr>
				<tr>
					<td><button class="btn btn-link" href="#">Link</button></td>
					<td><code>btn btn-link</code></td>
					<td>Deemphasize a button by making it look like a link while maintaining button behavior</td>
				</tr>
			</tbody>
		</table>

		<div class="row">
			<div class="span6">
				<h3>Buttons for actions</h3>
				<p>As a convention, buttons should only be used for actions while hyperlinks are to be used for objects. For instance, "Download" should be a button while "recent activity" should be a link.</p>
				<p>Button styles can be applied to anything with the <code>.btn</code> class applied. However, typically you'll want to apply these to only <code>&lt;a&gt;</code> and <code>&lt;button&gt;</code> elements.</p>
			</div>
			<div class="span6">
				<h3>Cross browser compatibility</h3>
				<p>IE9 doesn't crop background gradients on rounded corners, so we remove it. Related, IE9 jankifies disabled <code>button</code> elements, rendering text gray with a nasty text-shadow that we cannot fix.</p>
			</div>
		</div>

		<h3>Multiple sizes</h3>
		<div class="row">
			<div class="span4">
				<p>Fancy larger or smaller buttons? Add <code>.btn-large</code>, <code>.btn-small</code>, or <code>.btn-mini</code> for two additional sizes.</p>
			</div>
			<div class="span8">
				<div class="example">
					<p>
						<button class="btn btn-huge btn-primary">Huge</button>
						<button class="btn btn-huge">Huge</button>
					</p>
					<p>
						<button class="btn btn-large btn-primary">Large</button>
						<button class="btn btn-large">Large</button>
					</p>
					<p>
						<button class="btn btn-primary">Default</button>
						<button class="btn">Default</button>
					</p>
					<p>
						<button class="btn btn-small btn-primary">Small</button>
						<button class="btn btn-small">Small</button>
					</p>
					<p>
						<button class="btn btn-mini btn-primary">Mini</button>
						<button class="btn btn-mini">Mini</button>
					</p>
					<p>
						<button class="btn btn-primary btn-block">Block level</button>
						<button class="btn btn-block">Block level</button>
					</p>
				</div>
			</div>
		</div>

		<h3>Disabled state</h3>
		<div class="row">
			<div class="span4">
				<p>For disabled buttons, add the <code>.disabled</code> class to links and the <code>disabled</code> attribute for <code>&lt;button&gt;</code> elements.</p>
			</div>
			<div class="span8">
				<div class="example">
					<p>
						<a href="#" class="btn btn-large btn-primary disabled">Disabled</a>
						<a href="#" class="btn btn-large disabled">Disabled</a>
					</p>
				</div>
				<p>
					<span class="label label-info">Heads up!</span>
					We use <code>.disabled</code> as a utility class here, similar to the common <code>.active</code> class, so no prefix is required.
				</p>
			</div>
		</div>

		<h3>One class, multiple tags</h3>
		<div class="row">
			<div class="span4">
				<p>Use the <code>.btn</code> class on an <code>&lt;a&gt;</code>, <code>&lt;button&gt;</code>, or <code>&lt;input&gt;</code> element.</p>
			</div>
			<div class="span8">
				<div class="example">
					<form>
						<a class="btn" href="">Link</a>
						<button class="btn" type="submit">Button</button>
						<input class="btn" type="button" value="Input">
						<input class="btn" type="submit" value="Submit">
					</form>
				</div>
				<pre class="prettyprint linenums">
&lt;a class="btn" href=""&gt; ... &lt;/a&gt;
&lt;button class="btn" type="submit"&gt; ... &lt;/button&gt;
&lt;input class="btn" type="button" value="Input"&gt;
&lt;input class="btn" type="submit" value="Submit"&gt;</pre>
				<p>As a best practice, try to match the element for you context to ensure matching cross-browser rendering. If you have an <code>input</code>, use an <code>&lt;input type="submit"&gt;</code> for your button.</p>
			</div>
		</div>

		<h3>Round buttons (Pills)</h3>
		<div class="row">
			<div class="span4">
				<p>With <code>.btn-soft</code> or <code>.btn-rounded</code> you can make a rounded pill like button.</p>
			</div>
			<div class="span8">
				<div class="example">
					<form>
						<a class="btn btn-rounded" href="">Link</a>
						<button class="btn btn-soft" type="submit">Button</button>
						<input class="btn btn-soft" type="button" value="Input">
						<input class="btn btn-rounded" type="submit" value="Submit">
					</form>
				</div>
				<pre class="prettyprint linenums">
&lt;a class="btn btn-soft" href=""&gt; ... &lt;/a&gt;
&lt;a class="btn btn-rounded" href=""&gt; ... &lt;/a&gt;</pre>
			</div>
		</div>

		<h3>Hidden text expansion button (...)</h3>
		<div class="row">
			<div class="span4">
				<p>Use <code>.hidden-text-expander</code> to indicate and expand hidden text.</p>
			</div>
			<div class="span8">
				<div class="example">
					<form>
						<span class="hidden-text-expander"><a href="#">…</a></span>
					</form>
				</div>
				<pre class="prettyprint linenums">
&lt;span class="hidden-text-expander" href=""&gt;
  &lt;a href="#"&gt; ... &lt;/a&gt;
&lt;/span&gt;</pre>
			</div>
		</div>
	</section>


	<!-- Button Groups
	================================================== -->
	<section id="buttonGroups">
		<div class="page-header">
			<h1>Button groups <small>Join buttons for more toolbar-like functionality</small></h1>
		</div>
		<div class="row">
			<div class="span4">
				<p>Use button groups to join multiple buttons together as one composite component. Build them with a series of <code>&lt;a&gt;</code> or <code>&lt;button&gt;</code> elements.</p>
				<h3>Best practices</h3>
				<p>We recommend the following guidelines for using button groups and toolbars:</p>
				<ul>
					<li>Always use the same element in a single button group, <code>&lt;a&gt;</code> or <code>&lt;button&gt;</code>.</li>
					<li>Don't mix buttons of different colors in the same button group.</li>
					<li>Use icons in addition to or instead of text, but be sure include alt and title text where appropriate.</li>
				</ul>
				<p><span class="label label-info">Related</span> Button groups with dropdowns (see below) should be called out separately and always include a dropdown caret to indicate intended behavior.</p>
			</div>
			<div class="span8">
				<div class="example">
					<div class="btn-group" style="margin: 9px 0;">
						<button class="btn">Left</button>
						<button class="btn">Middle</button>
						<button class="btn">Right</button>
					</div>
				</div>
				<pre class="prettyprint linenums">
&lt;div class="btn-group"&gt;
  &lt;button class="btn"&gt;1&lt;/button&gt;
  &lt;button class="btn"&gt;2&lt;/button&gt;
  &lt;button class="btn"&gt;3&lt;/button&gt;
&lt;/div&gt;</pre>
			</div>
		</div>

		<h3>Toolbar example</h3>
		<div class="row">
			<div class="span4">
				<p>Combine sets of <code>&lt;div class="btn-group"&gt;</code> into a <code>&lt;div class="btn-toolbar"&gt;</code> for more complex components.</p>
			</div>
			<div class="span8">
				<div class="example">
					<div class="btn-toolbar">
						<div class="btn-group">
							<button class="btn">1</button>
							<button class="btn">2</button>
							<button class="btn">3</button>
							<button class="btn">4</button>
						</div>
						<div class="btn-group">
							<button class="btn">5</button>
							<button class="btn">6</button>
							<button class="btn">7</button>
						</div>
						<div class="btn-group">
							<button class="btn">8</button>
						</div>
					</div>
				</div>
				<pre class="prettyprint linenums">
&lt;div class="btn-toolbar"&gt;
  &lt;div class="btn-group"&gt;
    ...
  &lt;/div&gt;
&lt;/div&gt;</pre>
			</div>
		</div>
		<div class="row">
			<div class="span6">
				<h3>Checkbox and radio flavors</h3>
				<p>Button groups can also function as radios, where only one button may be active, or checkboxes, where any number of buttons may be active. View <a href="./javascript.html#buttons">the Javascript docs</a> for that.</p>
				<p><a class="btn js-btn" href="./javascript.html#buttons">Get the javascript &raquo;</a></p>
			</div>
			<div class="span6">
				<h3>Dropdowns in button groups</h3>
				<p><span class="label label-info">Heads up!</span> Buttons with dropdowns must be individually wrapped in their own <code>.btn-group</code> within a <code>.btn-toolbar</code> for proper rendering.</p>
			</div>
		</div>
	</section>


	<!-- Split button dropdowns
	================================================== -->
	<section id="buttonDropdowns">
		<div class="page-header">
			<h1>Button dropdown <small>Built on button groups to provide contextual menus</small></h1>
		</div>

		<div class="row">
			<div class="span4">
				<p>Use any button to trigger a dropdown menu by placing it within a <code>.btn-group</code> and providing the proper menu markup.</p>
				<p>Similar to a button group, our markup uses regular button markup, but with a handful of additions to refine the style and support Diamond's dropdown jQuery plugin.</p>
			</div>
			<div class="span8">
				<div class="example">
					<div class="btn-toolbar" style="margin-top: 18px;">
						<div class="btn-group">
							<button class="btn dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div><!-- /btn-group -->
						<div class="btn-group">
							<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div><!-- /btn-group -->
						<div class="btn-group">
							<button class="btn btn-danger dropdown-toggle" data-toggle="dropdown">Danger <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div><!-- /btn-group -->
					</div>
					<div class="btn-toolbar">
						<div class="btn-group">
							<button class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Warning <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div><!-- /btn-group -->
						<div class="btn-group">
							<button class="btn btn-success dropdown-toggle" data-toggle="dropdown">Success <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div><!-- /btn-group -->
						<div class="btn-group">
							<button class="btn btn-info dropdown-toggle" data-toggle="dropdown">Info <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div><!-- /btn-group -->
						<div class="btn-group">
							<button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">Inverse <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div><!-- /btn-group -->
					</div><!-- /btn-toolbar -->
				</div>
				<pre class="prettyprint linenums">
&lt;div class="btn-group"&gt;
  &lt;a class="btn dropdown-toggle" data-toggle="dropdown" href="#"&gt;
    Action
    &lt;span class="caret"&gt;&lt;/span&gt;
  &lt;/a&gt;
  &lt;ul class="dropdown-menu"&gt;
    &lt;!-- dropdown menu links --&gt;
  &lt;/ul&gt;
&lt;/div&gt;</pre>
			</div>
		</div>
		<div class="row">
			<div class="span6">
				<h3>Works with all button sizes</h3>
				<p>Button dropdowns work at any size. your button sizes to <code>.btn-large</code>, <code>.btn-small</code>, or <code>.btn-mini</code>.</p>
				<div class="btn-toolbar" style="margin-top: 18px;">
					<div class="btn-group">
						<button class="btn btn-large dropdown-toggle" data-toggle="dropdown">Large button <span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
					</div><!-- /btn-group -->
					<div class="btn-group">
						<button class="btn btn-small dropdown-toggle" data-toggle="dropdown">Small button <span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
					</div><!-- /btn-group -->
					<div class="btn-group">
						<button class="btn btn-mini dropdown-toggle" data-toggle="dropdown">Mini button <span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
					</div><!-- /btn-group -->
				</div><!-- /btn-toolbar -->
			</div><!--/span-->
			<div class="span6">
				<h3>Requires javascript</h3>
				<p>Button dropdowns require the <a href="./javascript.html#dropdowns">Diamond dropdown plugin</a> to function.</p>
				<p>In some cases&mdash;like mobile&mdash;dropdown menus will extend outside the viewport. You need to resolve the alignment manually or with custom javascript.</p>
			</div><!--/span-->
		</div><!--/row-->
		<br>

		<h2>Split button dropdowns</h2>
		<div class="row">
			<div class="span4">
				<p>Building on the button group styles and markup, we can easily create a split button. Split buttons feature a standard action on the left and a dropdown toggle on the right with contextual links.</p>
				<p>We expand on the normal button dropdowns to provide a second button action that operates as a separate dropdown trigger.</p>
			</div>
			<div class="span8">
				<div class="example">
					<div class="btn-toolbar" style="margin-top: 18px;">
						<div class="btn-group">
							<button class="btn">Action</button>
							<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div><!-- /btn-group -->
						<div class="btn-group">
							<button class="btn btn-primary">Action</button>
							<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div><!-- /btn-group -->
						<div class="btn-group">
							<button class="btn btn-danger">Danger</button>
							<button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div><!-- /btn-group -->
					</div>
					<div class="btn-toolbar">
						<div class="btn-group">
							<button class="btn btn-warning">Warning</button>
							<button class="btn btn-warning dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div><!-- /btn-group -->
						<div class="btn-group">
							<button class="btn btn-success">Success</button>
							<button class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div><!-- /btn-group -->
						<div class="btn-group">
							<button class="btn btn-info">Info</button>
							<button class="btn btn-info dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div><!-- /btn-group -->
					</div>
					<div class="btn-toolbar">
						<div class="btn-group">
							<button class="btn btn-inverse">Inverse</button>
							<button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div><!-- /btn-group -->
					</div><!-- /btn-toolbar -->
				</div>
				<pre class="prettyprint linenums">
&lt;div class="btn-group"&gt;
  &lt;button class="btn"&gt;Action&lt;/button&gt;
  &lt;button class="btn dropdown-toggle" data-toggle="dropdown"&gt;
    &lt;span class="caret"&gt;&lt;/span&gt;
  &lt;/button&gt;
  &lt;ul class="dropdown-menu"&gt;
    &lt;!-- dropdown menu links --&gt;
  &lt;/ul&gt;
&lt;/div&gt;</pre>
			</div>
		</div>

		<h3>Sizes</h3>
		<div class="row">
			<div class="span4">
				<p>Utilize the extra button classe <code>.btn-mini</code>, <code>.btn-small</code>, or <code>.btn-large</code> for sizing.</p>
			</div>
			<div class="span8">
				<div class="example">
					<div class="btn-toolbar">
						<div class="btn-group">
							<button class="btn btn-large">Large action</button>
							<button class="btn btn-large dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div><!-- /btn-group -->
					</div><!-- /btn-toolbar -->
					<div class="btn-toolbar">
						<div class="btn-group">
							<button class="btn btn-small">Small action</button>
							<button class="btn btn-small dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div><!-- /btn-group -->
					</div><!-- /btn-toolbar -->
					<div class="btn-toolbar">
						<div class="btn-group">
							<button class="btn btn-mini">Mini action</button>
							<button class="btn btn-mini dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div><!-- /btn-group -->
					</div><!-- /btn-toolbar -->
				</div>
				<pre class="prettyprint linenums">
&lt;div class="btn-group"&gt;
  ...
  &lt;ul class="dropdown-menu pull-right"&gt;
    &lt;!-- dropdown menu links --&gt;
  &lt;/ul&gt;
&lt;/div&gt;</pre>
			</div>
		</div>

		<h3>Dropup menus</h3>
		<div class="row">
			<div class="span4">
				<p>Dropdown menus can also be toggled from the bottom up by adding a single class to the immediate parent of <code>.dropdown-menu</code>. It will flip the direction of the <code>.caret</code> and reposition the menu itself to move from the bottom up instead of top down.</p>
			</div>
			<div class="span8">
				<div class="example">
					<div class="btn-toolbar" style="margin-top: 9px;">
						<div class="btn-group dropup">
							<button class="btn">Dropup</button>
							<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div><!-- /btn-group -->
						<div class="btn-group dropup">
							<button class="btn primary">Right dropup</button>
							<button class="btn primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
							<ul class="dropdown-menu pull-right">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div><!-- /btn-group -->
					</div>
				</div>
				<pre class="prettyprint linenums">
&lt;div class="btn-group dropup"&gt;
  &lt;button class="btn"&gt;Dropup&lt;/button&gt;
  &lt;button class="btn dropdown-toggle" data-toggle="dropdown"&gt;
    &lt;span class="caret"&gt;&lt;/span&gt;
  &lt;/button&gt;
  &lt;ul class="dropdown-menu"&gt;
    &lt;!-- dropdown menu links --&gt;
  &lt;/ul&gt;
&lt;/div&gt;</pre>

			</div>
		</div>
	</section>



	<!-- Social Count button
	================================================== -->
	<section id="social-count-button">
		<div class="page-header">
			<h1>Social Count button</h1>
		</div>
		<div class="row">
			<div class="span4">
				<p>A container that is used for social bubbles counts. <code>.social-count</code> - social count bubble number.</p>
			</div>
			<div class="span8">
				<div class="example">
					<a class="btn txt-blue"><i class="icon-facebook"></i></a><a class="social-count">235</a>
					<a class="btn txt-bluelight"><i class="icon-twitter"></i></a><a class="social-count">124</a>
					<a class="btn txt-red"><i class="icon-google-plus"></i></a><a class="social-count">359</a>
				</div>
				<pre class="prettyprint linenums">&lt;a class="social-count"&gt;235&lt;/a&gt;</pre>
			</div>


	</section>



</div><!-- /container -->

<?php $this->load->view('diamond/footer'); ?>
