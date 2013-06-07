
<div id="page" class="container">

	<div class="container">

		<!-- Masthead
		================================================== -->
		<header id="overview">
			<h1>Base CSS</h1>
			<p class="lead">On top of the scaffolding, basic HTML elements are styled and enhanced with extensible classes to provide a fresh, consistent look and feel.</p>
			<div class="subnav">
				<ul class="nav nav-pills">
					<li><a href="#typography">Typography</a></li>
					<li><a href="#code">Code</a></li>
					<li><a href="#tables">Tables</a></li>
					<li><a href="#forms">Forms</a></li>
					<li><a href="#images">Images</a></li>
					<li><a href="#colors">Colors</a></li>
				</ul>
			</div>
		</header>


		<!-- Typography
		================================================== -->
		<section id="typography">
			<div class="page-header">
				<h1>Typography <small>Headings, paragraphs, lists, and other inline type elements</small></h1>
			</div>

			<h2>Font stacks</h2>
			<div class="row">
				<div class="span4">
					<p>There are 3 default font stacks you can use by adding there class.</p>
				</div>
				<div class="span8">
					<div class="example">
						<p class="sansfont">This is the sans serif font. Use <code>.sansfont</code>.</p>
						<p class="seriffont">This is the serif font. Use <code>.seriffont</code>.</p>
						<p class="monofont">This is the mono font. Use <code>.monofont</code>.</p>
					</div>
				</div>
			</div>

			<h2>Headings &amp; body copy</h2>

			<!-- Headings & Paragraph Copy -->
			<div class="row">
				<div class="span4">
					<h3>Typographic scale</h3>
					<p>Diamond's global default <code>font-size</code> is 14px, with a <code>line-height</code> of 20px. This is applied to the <code>&lt;body&gt;</code> and all paragraphs. In addition, <code>&lt;p&gt;</code> (paragraphs) receive a bottom margin of half their line-height (10px by default).</p>
					<p>The entire typographic grid is based on two Less variables in our variables.less file: <code>@baseFontSize</code> and <code>@baseLineHeight</code>. The first is the base font-size used throughout and the second is the base line-height.</p>
					<p>We use those variables, and some math, to create the margins, paddings, and line-heights of all our type and more.</p>
				</div>
				<div class="span8">
					<div class="example">
						<p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
						<p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui.</p>
					</div>
					<pre class="prettyprint linenums">&lt;p&gt;...&lt;/p&gt;</pre>
				</div>
			</div>
			<div class="row">
				<div class="span4">
					<h3>Headings and subheadings</h3>
					<p>All HTML headings, <code>&lt;h1&gt;</code> through <code>&lt;h6&gt;</code> are available.</p>
					<p>Ad a <code>&LT;small&gt;</code> tag inside the headings for a subtitle / subheading. The subheadings are positions inline as default. Add the class <code>.block</code> to place them on a new line (like the first example).</p>
				</div>
				<div class="span8">
					<div class="example">
						<h1>Heading 1 <small class="block">This is the subheading</small></h1>
						<h2>Heading 2 <small>This is the subheading</small></h2>
						<h3>Heading 3 <small>This is the subheading</small></h3>
						<h4>Heading 4 <small>This is the subheading</small></h4>
						<h5>Heading 5 <small>This is the subheading</small></h5>
						<h6>Heading 6 <small>This is the subheading</small></h6>
					</div>
					<pre class="prettyprint linenums">&lt;h1&gt;Title &lt;small class="block"&gt;Subtitle&lt;small&gt;&lt;/h1&gt;</pre>
				</div>
			</div>
			<div class="row">
				<div class="span4">
					<h3>Lead body copy</h3>
					<p>Make a paragraph stand out by adding <code>.lead</code>.</p>
				</div>
				<div class="span8">
					<div class="example">
						<p class="lead">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus.</p>
					</div>
					<pre class="prettyprint linenums">&lt;p class="lead"&gt;...&lt;/p&gt;</pre>
				</div>
			</div>

			<!-- Alignments -->
			<h2>Alignment classes</h2>
			<div class="row">
				<div class="span4">
					<p>Easily realign text to components with text alignment classes.</p>	
				</div>
				<div class="span8">
					<div class="example">
						<p class="text-left">Left aligned text.</p>
						<p class="text-center">Center aligned text.</p>
						<p class="text-right">Right aligned text.</p>
					</div>
					<pre class="prettyprint linenums">&lt;p class="text-left"&gt;...&lt;/p&gt;
&lt;p class="text-center"&gt;...&lt;/p&gt;
&lt;p class="text-right"&gt;...&lt;/p&gt;</pre>
				</div>
			</div>


			<!-- Misc Elements -->
			<h2>Emphasis, address, and abbreviation</h2>
			<div class="row">
				<div class="span4">
					<p><a href="#">Fusce dapibus</a>, <strong>tellus ac cursus commodo</strong>, <em>tortor mauris condimentum nibh</em>, ut fermentum massa justo sit amet risus. Maecenas faucibus mollis interdum. Nulla vitae elit libero, a pharetra augue.</p>
					<p><strong>Note:</strong> Feel free to use <code>&lt;b&gt;</code> and <code>&lt;i&gt;</code> in HTML5, but their usage has changed a bit. <code>&lt;b&gt;</code> is meant to highlight words or phrases without conveying additional importance while <code>&lt;i&gt;</code> is mostly for voice, technical terms, etc.</p>
				</div>
				<div class="span8">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Element</th>
								<th>Usage</th>
								<th>Optional</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<code>&lt;strong&gt;</code>
								</td>
								<td>
									For emphasizing a snippet of text with <strong>important</strong>
								</td>
								<td>
									<span class="muted">None</span>
								</td>
							</tr>
							<tr>
								<td>
									<code>&lt;em&gt;</code>
								</td>
								<td>
									For emphasizing a snippet of text with <em>stress</em>
								</td>
								<td>
									<span class="muted">None</span>
								</td>
							</tr>
							<tr>
								<td>
									<code>&lt;abbr&gt;</code>
								</td>
								<td>
									Wraps abbreviations and acronyms to show the expanded version on hover
								</td>
								<td>
									<p>Include optional <code>title</code> attribute for expanded text</p>
									Use <code>.initialism</code> class for uppercase abbreviations.
								</td>
							</tr>
							<tr>
								<td>
									<code>&lt;address&gt;</code>
								</td>
								<td>
									For contact information for its nearest ancestor or the entire body of work
								</td>
								<td>
									Preserve formatting by ending all lines with <code>&lt;br&gt;</code>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

			</div>

			<h3>Example addresses</h3>
			<div class="row">
				<div class="span4">
					<p>Here are two examples of how the <code>&lt;address&gt;</code> tag can be used:</p>
				</div>
				<div class="span8">
					<div class="example">
						<address>
							<strong>Twitter, Inc.</strong><br>
							795 Folsom Ave, Suite 600<br>
							San Francisco, CA 94107<br>
							<abbr title="Phone">P:</abbr> (123) 456-7890
						</address>
						<address>
							<strong>Full Name</strong><br>
							<a href="mailto:#">first.last@gmail.com</a>
						</address>
					</div>
					<pre class="prettyprint linenums">&lt;address&gt; ... &lt;/address&gt;</pre>
				</div>
			</div>

			<h3>Example abbreviations</h3>
			<div class="row">
				<div class="span4">
					<p>Abbreviations with a <code>title</code> attribute have a light dotted bottom border and a help cursor on hover. This gives users extra indication something will be shown on hover.</p>
					<p>Add the <code>initialism</code> class to an abbreviation to increase typographic harmony by giving it a slightly smaller text size.</p>
				</div>
				<div class="span8">
					<div class="example">
						<p><abbr title="HyperText Markup Language" class="initialism">HTML</abbr> is the best thing since sliced bread.</p>
						<p>An abbreviation of the word attribute is <abbr title="attribute">attr</abbr>.</p>
					</div>
					<pre class="prettyprint linenums">&lt;abbr title="..." class="initialism"&gt; ... &lt;/abbr&gt;</pre>
				</div>
			</div>

			<h3>Emphasis classes</h3>
			<div class="row">
				<div class="span4">
					<p>Convey meaning through color with a handful of emphasis utility classes.</p>
				</div>
				<div class="span8">
					<div class="example">
						<p class="muted">Fusce dapibus, tellus ac cursus commodo, tortor mauris nibh.</p>
						<p class="text-warning">Etiam porta sem malesuada magna mollis euismod.</p>
						<p class="text-error">Donec ullamcorper nulla non metus auctor fringilla.</p>
						<p class="text-info">Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis.</p>
						<p class="text-success">Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
					</div>
					<pre class="prettyprint linenums">
&lt;p class="muted"&gt; ... &lt;/p&gt;
&lt;p class="text-warning"&gt; ... &lt;/p&gt;
&lt;p class="text-error"&gt; ... &lt;/p&gt;
&lt;p class="text-info"&gt; ... &lt;/p&gt;
&lt;p class="text-success"&gt; ... &lt;/p&gt;</pre>
				</div>			
			</div>

			<!-- Deletion (striketrough) -->
			<h3>Deletion (striketrough)</h3>
			<div class="row">
				<div class="span4">
					<p>The <code>s</code> element is used to represent content that is no longer accurate or relevant. When indicating document edits i.e., marking a span of text as having been removed from a document, use the <code>del</code> element instead.</p>
				</div>
				<div class="span8">
					<div class="example">
						<p>Retail price: <s>$3.99</s>, now $3.45</p>
					</div>
					<pre class="prettyprint linenums">
&lt;s&gt; ... &lt;/s&gt;
&lt;strike&gt; ... &lt;/strike&gt;
&lt;del&gt; ... &lt;/del&gt;</pre>
				</div>			
			</div>

			<!-- Insertion -->
			<h3>Insertion</h3>
			<div class="row">
				<div class="span4">
					<p>The <code>del</code> element is used to represent deleted or retracted text which still must remain on the page for some reason. Meanwhile its counterpart, the <code>ins</code> element, is used to represent inserted text. Both del and ins have a datetime attribute which allows you to include a timestamp directly in the element.</p>
				</div>
				<div class="span8">
					<div class="example">
						<p>She bought <del datetime="2005-05-30T13:00:00">two</del> <ins datetime="2005-05-30T13:00:00">five</ins> pairs of shoes.</p>
					</div>
					<pre class="prettyprint linenums">
&lt;ins datetime=" ... "&gt; ... &lt;/ins&gt;</pre>
				</div>			
			</div>

			<!-- Mark -->
			<h3>Mark or highlight</h3>
			<div class="row">
				<div class="span4">
					<p>The <code>mark</code> element is used to represent a run of text marked or highlighted for reference purposes. When used in a quotation it indicates a highlight not originally present but added to bring the reader’s attention to that part of the text. When used in the main prose of a document, it indicates a part of the document that has been highlighted due to its relevance to the user’s current activity.</p>
				</div>
				<div class="span8">
					<div class="example">
						<p>I also have some <mark>kitten</mark>s who are visiting me these days. They’re really cute. I think they like my garden! Maybe I should adopt a <mark>kitten</mark>.</p>
					</div>
					<pre class="prettyprint linenums">
&lt;mark&gt; ... &lt;/mark&gt;</pre>
				</div>			
			</div>

			<!-- Definition list -->
			<h3>Definition list</h3>
			<div class="row">
				<div class="span4">
					<p>The <code>mark</code> element is used to represent a run of text marked or highlighted for reference purposes. When used in a quotation it indicates a highlight not originally present but added to bring the reader’s attention to that part of the text. When used in the main prose of a document, it indicates a part of the document that has been highlighted due to its relevance to the user’s current activity.</p>
				</div>
				<div class="span8">
					<div class="example">
						<dl>
							<dt>This is a term.</dt>
							<dd>This is the definition of that term, which both live in a <code>dl</code>.</dd>
							<dt>Here is another term.</dt>
							<dd>And it gets a definition too, which is this line.</dd>
							<dt>Here is term that shares a definition with the term below.</dt>
							<dt>Here is a defined term.</dt>
							<dd><code>dt</code> terms may stand on their own without an accompanying <code>dd</code>, but in that case they <em>share</em> descriptions with the next available <code>dt</code>. You may not have a <code>dd</code> without a parent <code>dt</code>.</dd>
						</dl>
					</div>
					<pre class="prettyprint linenums">
&lt;dl&gt;
  &lt;dt&gt; term &lt;/dt&gt;
  &lt;dd&gt; description &lt;/dd&gt;
&lt;/dl&gt;</pre>
				</div>			
			</div>

			<!-- Superscript and subscript text -->
			<h3>Superscript and subscript text</h3>
			<div class="row">
				<div class="span4">
					<p>The <code>sup</code> element represents a superscript and the sub element represents a <code>sub</code>. These elements must be used only to mark up typographical conventions with specific meanings, not for typographical presentation. As a guide, only use these elements if their absence would change the meaning of the content.</p>
				</div>
				<div class="span8">
					<div class="example">
						<p>The coordinate of the <var>i</var>th point is (<var>x<sub><var>i</var></sub></var>, <var>y<sub><var>i</var></sub></var>). For example, the 10th point has coordinate (<var>x<sub>10</sub></var>, <var>y<sub>10</sub></var>).</p>
						<p>f(<var>x</var>, <var>n</var>) = log<sub>4</sub><var>x</var><sup><var>n</var></sup></p>
					</div>
					<pre class="prettyprint linenums">
&lt;sub&gt; ... &lt;/sub&gt;
&lt;sup&gt; ... &lt;/sup&gt;</pre>
				</div>			
			</div>

			<!-- Drop caps -->
			<h3>Drop caps</h3>
			<div class="row">
				<div class="span4">
					<p>A Drop Cap is the art of using an uppercase glyph to mark the start of copy. A technique that has been around for almost two thousand years!</p>
				</div>
				<div class="span8">
					<div class="example">
						<p class="drop-cap">There now is your insular city of the Manhattoes, belted round by wharves as Indian isles by coral reefs—commerce surrounds it with her surf. Right and left, the streets take you waterward. Its extreme downtown is the battery, where that noble mole is washed by waves, and cooled by breezes, which a few hours previous were out of sight of land. Look at the crowds of water-gazers there.</p>
					</div>
					<pre class="prettyprint linenums">&lt;p class="drop-cap"&gt; ... &lt;/p&gt;</pre>
				</div>			
			</div>

			<!-- Variable -->
			<h3>Variable</h3>
			<div class="row">
				<div class="span4">
					<p>The <code>var</code> element is used to denote a variable in a mathematical expression or programming context, but can also be used to indicate a placeholder where the contents should be replaced with your own value.</p>
				</div>
				<div class="span8">
					<div class="example">
						<p>If there are <var>n</var> pipes leading to the ice cream factory then I expect at <em>least</em> <var>n</var> flavours of ice cream to be available for purchase!</p>
					</div>
					<pre class="prettyprint linenums">&lt;var&gt; ... &lt;/var&gt;</pre>
				</div>			
			</div>

			<!-- Sample -->
			<h3>Sample outpu</h3>
			<div class="row">
				<div class="span4">
					<p>The <code>samp</code> element is used to represent (sample) output from a program or computing system. Useful for technology-oriented sites, not so useful otherwise.</p>
				</div>
				<div class="span8">
					<div class="example">
						<p>The computer said <samp>Too much cheese in tray two</samp> but I didn’t know what that meant.</p>
					</div>
					<pre class="prettyprint linenums">&lt;samp&gt; ... &lt;/samp&gt;</pre>
				</div>			
			</div>

			<!-- Keyboard -->
			<h3>Keyboard entry</h3>
			<div class="row">
				<div class="span4">
					<p>The <code>kbd</code> element is used to denote user input (typically via a keyboard, although it may also be used to represent other input methods, such as voice commands).</p>
				</div>
				<div class="span8">
					<div class="example">
						<p>To take a screenshot on your Mac, press <kbd>⌘ Cmd</kbd> + <kbd>⇧ Shift</kbd> + <kbd>3</kbd>.</p>
					</div>
					<pre class="prettyprint linenums">&lt;kbd&gt; ... &lt;/kbd&gt;</pre>
				</div>			
			</div>

			<!-- Blockquotes -->
			<h2>Blockquotes</h2>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Element</th>
						<th>Usage</th>
						<th>Optional</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<code>&lt;blockquote&gt;</code>
						</td>
						<td>
							Block-level element for quoting content from another source
						</td>
						<td>
							<p>Add <code>cite</code> attribute for source URL</p>
							Use <code>.pull-left</code> and <code>.pull-right</code> classes for floated options
						</td>
					</tr>
					<tr>
						<td>
							<code>&lt;small&gt;</code>
						</td>
						<td>
							Optional element for adding a user-facing citation, typically an author with title of work
						</td>
						<td>
							Place the <code>&lt;cite&gt;</code> around the title or name of source
						</td>
					</tr>
				</tbody>
			</table>

			<div class="row">
				<div class="span4">
					<p>To include a blockquote, wrap <code>&lt;blockquote&gt;</code> around any <abbr title="HyperText Markup Language">HTML</abbr> as the quote. For straight quotes we recommend a <code>&lt;p&gt;</code>.</p>
					<p>To float your blockquote to the right, add <code>class="pull-right"</code>:</p>
				</div>
				<div class="span8">
					<div class="example">
						<blockquote>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis.</p>
							<small>Someone famous in <cite title="">Body of work</cite></small>
						</blockquote>
						<blockquote class="pull-right">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis.</p>
							<small>Someone famous in <cite title="">Body of work</cite></small>
						</blockquote>
						<div class="clearfix"></div>
					</div>
					<pre class="prettyprint linenums">
&lt;blockquote&gt;
  &lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis.&lt;/p&gt;
  &lt;small&gt;Someone famous&lt;/small&gt;
&lt;/blockquote&gt;</pre>
				</div>
			</div>

			<h3>Inline quotes</h3>
			<div class="row">
				<div class="span4">
					<p>The <code>q</code> element is used for quoting text inline.</p>
				</div>
				<div class="span8">
					<div class="example">
						<p>John said, <q>I saw Lucy at lunch, she told me <q>Mary wants you to get some ice cream on your way home</q>. I think I will get some at Ben and Jerry’s, on Gloucester Road.</q></p>
					</div>
					<pre class="prettyprint linenums">&lt;q&gt; ... &lt;/q&gt;</pre>
				</div>
			</div>

			<!-- Lists -->
			<h2>Lists</h2>
			<div class="row">
				<div class="span4">
					<h3>Unordered</h3>
					<p><code>&lt;ul&gt;</code></p>
					<ul>
						<li>Facilisis in pretium nisl aliquet</li>
						<li>Nulla volutpat aliquam velit
							<ul>
								<li>Vestibulum laoreet porttitor sem</li>
								<li>Ac tristique libero volutpat at</li>
							</ul>
						</li>
						<li>Faucibus porta lacus fringilla vel</li>
					</ul>
				</div>
				<div class="span4">
					<h3>Unstyled</h3>
					<p><code>&lt;ul class="unstyled"&gt;</code></p>
					<ul class="unstyled">
						<li>Integer molestie lorem at massa</li>
						<li>Nulla volutpat aliquam velit
							<ul>
								<li>Phasellus iaculis neque</li>
								<li>Purus sodales ultricies</li>
							</ul>
						</li>
						<li>Faucibus porta lacus fringilla vel</li>
					</ul>
				</div>
				<div class="span4">
					<h3>Ordered</h3>
					<p><code>&lt;ol&gt;</code></p>
					<ol>
						<li>Lorem ipsum dolor sit amet</li>
						<li>Consectetur adipiscing elit</li>
						<li>Integer molestie lorem at massa</li>
					</ol>
				</div>
			</div><!-- /row -->
			<br>
			<div class="row">
				<div class="span4">
					<h3>Description</h3>
					<p><code>&lt;dl&gt;</code></p>
					<dl>
						<dt>Description lists</dt>
						<dd>A description list is perfect for defining terms.</dd>
						<dt>Euismod</dt>
						<dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
						<dd>Donec id elit non mi porta gravida at eget metus.</dd>
						<dt>Malesuada porta</dt>
						<dd>Etiam porta sem malesuada magna mollis euismod.</dd>
					</dl>
				</div>
				<div class="span8">
					<h3>Horizontal description</h3>
					<p><code>&lt;dl class="dl-horizontal"&gt;</code></p>
					<dl class="dl-horizontal">
						<dt>Description lists</dt>
						<dd>A description list is perfect for defining terms.</dd>
						<dt>Euismod</dt>
						<dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
						<dd>Donec id elit non mi porta gravida at eget metus.</dd>
						<dt>Malesuada porta</dt>
						<dd>Etiam porta sem malesuada magna mollis euismod.</dd>
					</dl>
				</div>
			</div><!-- /row -->
		</section>



		<!-- Code
		================================================== -->
		<section id="code">
			<div class="page-header">
				<h1>Code <small>Inline and block code snippets</small></h1>
			</div>
			<h2>Inline</h2>
			<div class="row">
				<div class="span4">
					<p>Wrap inline snippets of code with <code>&lt;code&gt;</code>.</p>
				</div>
				<div class="span8">
					<pre class="prettyprint linenums">For example, &lt;code&gt;section&lt;/code&gt; should be wrapped as inline.</pre>
				</div><!--/span-->
			</div>

			<h2>Basic block</h2>
			<div class="row">
				<div class="span4">
					<p>Use <code>&lt;pre&gt;</code> for multiple lines of code. Be sure to escape any angle brackets in the code for proper rendering.</p>
					<p><strong>Note:</strong> Be sure to keep code within <code>&lt;pre&gt;</code> tags as close to the left as possible; it will render all tabs.</p>
					<p>You may optionally add the <code>.pre-scrollable</code> class which will set a max-height of 350px and provide a y-axis scrollbar.</p>
				</div>
				<div class="span8">
					<div class="example">
						<pre>&lt;p&gt;Sample text here...&lt;/p&gt;</pre>
					</div>
					<pre class="prettyprint linenums" style="margin-bottom: 9px;">
&lt;pre&gt;
  &amp;lt;p&amp;gt;Sample text here...&amp;lt;/p&amp;gt;
&lt;/pre&gt;</pre>
				</div><!--/span-->
			</div>
			<div class="row">
				<div class="span4">
					<h2>Google Prettify</h2>
					<p>Take the same <code>&lt;pre&gt;</code> element and add two optional classes for enhanced rendering.</p>
					<p><a href="http://code.google.com/p/google-code-prettify/">Download google-code-prettify</a> and view the readme for <a href="http://google-code-prettify.googlecode.com/svn/trunk/README.html">how to use</a>.</p>
				</div>
				<div class="span8">
					<div class="example">
						<pre class="prettyprint linenums" style="margin-bottom: 9px;">&lt;p&gt;Sample text here...&lt;/p&gt;</pre>
					</div>
					<pre class="prettyprint linenums" style="margin-bottom: 9px;">
&lt;pre class="prettyprint linenums"&gt;
  &amp;lt;p&amp;gt;Sample text here...&amp;lt;/p&amp;gt;
&lt;/pre&gt;</pre>
				</div><!--/span-->
			</div><!--/row-->
		</section>



		<!-- Tables
		================================================== -->
		<section id="tables">
			<div class="page-header">
				<h1>Tables <small>For, you guessed it, tabular data</small></h1>
			</div>

			<h2>Table markup</h2>
			<div class="row">
				<div class="span8">
					<table class="table table-bordered table-striped">
						<colgroup>
							<col class="span1">
							<col class="span7">
						</colgroup>
						<thead>
							<tr>
								<th>Tag</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<code>&lt;table&gt;</code>
								</td>
								<td>
									Wrapping element for displaying data in a tabular format
								</td>
							</tr>
							<tr>
								<td>
									<code>&lt;thead&gt;</code>
								</td>
								<td>
									Container element for table header rows (<code>&lt;tr&gt;</code>) to label table columns
								</td>
							</tr>
							<tr>
								<td>
									<code>&lt;tbody&gt;</code>
								</td>
								<td>
									Container element for table rows (<code>&lt;tr&gt;</code>) in the body of the table
								</td>
							</tr>
							<tr>
								<td>
									<code>&lt;tr&gt;</code>
								</td>
								<td>
									Container element for a set of table cells (<code>&lt;td&gt;</code> or <code>&lt;th&gt;</code>) that appears on a single row
								</td>
							</tr>
							<tr>
								<td>
									<code>&lt;td&gt;</code>
								</td>
								<td>
									Default table cell
								</td>
							</tr>
							<tr>
								<td>
									<code>&lt;th&gt;</code>
								</td>
								<td>
									Special table cell for column (or row, depending on scope and placement) labels<br>
									Must be used within a <code>&lt;thead&gt;</code>
								</td>
							</tr>
							<tr>
								<td>
									<code>&lt;caption&gt;</code>
								</td>
								<td>
									Description or summary of what the table holds, especially useful for screen readers
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="span4">
					<pre class="prettyprint linenums">
&lt;table&gt;
  &lt;thead&gt;
    &lt;tr&gt;
      &lt;th&gt;...&lt;/th&gt;
      &lt;th&gt;...&lt;/th&gt;
    &lt;/tr&gt;
  &lt;/thead&gt;
  &lt;tbody&gt;
    &lt;tr&gt;
      &lt;td&gt;...&lt;/td&gt;
      &lt;td&gt;...&lt;/td&gt;
    &lt;/tr&gt;
  &lt;/tbody&gt;
&lt;/table&gt;</pre>
				</div>
			</div>

			<h2>Table options</h2>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Name</th>
						<th>Class</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Default</td>
						<td class="muted">None</td>
						<td>No styles, just columns and rows</td>
					</tr>
					<tr>
						<td>Basic</td>
						<td>
							<code>.table</code>
						</td>
						<td>Only horizontal lines between rows</td>
					</tr>
					<tr>
						<td>Bordered</td>
						<td>
							<code>.table-bordered</code>
						</td>
						<td>Rounds corners and adds outer border</td>
					</tr>
					<tr>
						<td>Zebra-stripe</td>
						<td>
							<code>.table-striped</code>
						</td>
						<td>Adds light gray background color to odd rows (1, 3, 5, etc)</td>
					</tr>
					<tr>
						<td>Condensed</td>
						<td>
							<code>.table-condensed</code>
						</td>
						<td>Cuts vertical padding in half, from 8px to 4px, within all <code>td</code> and <code>th</code> elements</td>
					</tr>
				</tbody>
			</table>


			<h2>Example tables</h2>

			<h3>1. Default table styles</h3>
			<div class="row">
				<div class="span4">
					<p>Tables are automatically styled with only a few borders to ensure readability and maintain structure. With 2.0, the <code>.table</code> class is required.</p>
				</div>
				<div class="span8">
					<div class="example">
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Username</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Mark</td>
									<td>Otto</td>
									<td>@mdo</td>
								</tr>
								<tr>
									<td>2</td>
									<td>Jacob</td>
									<td>Thornton</td>
									<td>@fat</td>
								</tr>
								<tr>
									<td>3</td>
									<td>Larry</td>
									<td>the Bird</td>
									<td>@twitter</td>
								</tr>
							</tbody>
						</table>
					</div>
					<pre class="prettyprint linenums">
&lt;table class="table"&gt;
  ...
&lt;/table&gt;</pre>
				</div>
			</div>


			<h3>2. Striped table</h3>
			<div class="row">
				<div class="span4">
					<p>Get a little fancy with your tables by adding zebra-striping&mdash;just add the <code>.table-striped</code> class.</p>
					<p class="muted"><strong>Note:</strong> Striped tables use the <code>:nth-child</code> CSS selector and is not available in IE7-IE8.</p>
				</div>
				<div class="span8">
					<div class="example">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Username</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Mark</td>
									<td>Otto</td>
									<td>@mdo</td>
								</tr>
								<tr>
									<td>2</td>
									<td>Jacob</td>
									<td>Thornton</td>
									<td>@fat</td>
								</tr>
								<tr>
									<td>3</td>
									<td>Larry</td>
									<td>the Bird</td>
									<td>@twitter</td>
								</tr>
							</tbody>
						</table>
					</div>
					<pre class="prettyprint linenums" style="margin-bottom: 18px;">
&lt;table class="table table-striped"&gt;
  ...
&lt;/table&gt;</pre>
				</div>
			</div>


			<h3>3. Bordered table</h3>
			<div class="row">
				<div class="span4">
					<p>Add borders around the entire table and rounded corners for aesthetic purposes.</p>
				</div>
				<div class="span8">
					<div class="example">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>#</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Username</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td rowspan="2">1</td>
									<td>Mark</td>
									<td>Otto</td>
									<td>@mdo</td>
								</tr>
								<tr>
									<td>Mark</td>
									<td>Otto</td>
									<td>@TwBootstrap</td>
								</tr>
								<tr>
									<td>2</td>
									<td>Jacob</td>
									<td>Thornton</td>
									<td>@fat</td>
								</tr>
								<tr>
									<td>3</td>
									<td colspan="2">Larry the Bird</td>
									<td>@twitter</td>
								</tr>
							</tbody>
						</table>
					</div>
					<pre class="prettyprint linenums">
&lt;table class="table table-bordered"&gt;
  ...
&lt;/table&gt;</pre>
				</div>
			</div>


			<h3>4. Condensed table</h3>
			<div class="row">
				<div class="span4">
					<p>Make your tables more compact by adding the <code>.table-condensed</code> class to cut table cell padding in half (from 8px to 4px).</p>
				</div>
				<div class="span8">
					<div class="example">
						<table class="table table-condensed">
							<thead>
								<tr>
									<th>#</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Username</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Mark</td>
									<td>Otto</td>
									<td>@mdo</td>
								</tr>
								<tr>
									<td>2</td>
									<td>Jacob</td>
									<td>Thornton</td>
									<td>@fat</td>
								</tr>
								<tr>
									<td>3</td>
									<td colspan="2">Larry the Bird</td>
									<td>@twitter</td>
								</tr>
							</tbody>
						</table>
					</div>
					<pre class="prettyprint linenums" style="margin-bottom: 18px;">
&lt;table class="table table-condensed"&gt;
  ...
&lt;/table&gt;</pre>
				</div>
			</div>



			<h3>5. Hover table</h3>
			<div class="row">
				<div class="span4">
					<p>Feel free to combine any of the table classes to achieve different looks by utilizing any of the available classes.</p>
				</div>
				<div class="span8">
					<div class="example">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Username</th>
								</tr>
							</thead>
							<tbody>
								<tr>
								<tr>
									<td>1</td>
									<td>Mark</td>
									<td>Otto</td>
									<td>@mdo</td>
								</tr>
								<tr>
									<td>2</td>
									<td>Jacob</td>
									<td>Thornton</td>
									<td>@fat</td>
								</tr>
								<tr>
									<td>3</td>
									<td colspan="2">Larry the Bird</td>
									<td>@twitter</td>
								</tr>
							</tbody>
						</table>
					</div>
					<pre class="prettyprint linenums" style="margin-bottom: 18px;">
&lt;table class="table table-hover"&gt;
  ...
&lt;/table&gt;</pre>
				</div>
			</div>


			<h3>6. Combine them all!</h3>
			<div class="row">
				<div class="span4">
					<p>Feel free to combine any of the table classes to achieve different looks by utilizing any of the available classes.</p>
				</div>
				<div class="span8">
					<div class="example">
						<table class="table table-striped table-bordered table-condensed table-hover">
							<thead>
								<tr>
									<th></th>
									<th colspan="2">Full name</th>
									<th></th>
								</tr>
								<tr>
									<th>#</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Username</th>
								</tr>
							</thead>
							<tbody>
								<tr>
								<tr>
									<td>1</td>
									<td>Mark</td>
									<td>Otto</td>
									<td>@mdo</td>
								</tr>
								<tr>
									<td>2</td>
									<td>Jacob</td>
									<td>Thornton</td>
									<td>@fat</td>
								</tr>
								<tr>
									<td>3</td>
									<td colspan="2">Larry the Bird</td>
									<td>@twitter</td>
								</tr>
							</tbody>
						</table>
					</div>
					<pre class="prettyprint linenums" style="margin-bottom: 18px;">
&lt;table class="table table-striped table-bordered table-condensed table-hover"&gt;
  ...
&lt;/table&gt;</pre>
				</div>
			</div>



			<h3>Optional row classes</h3>
			<div class="row">
				<div class="span4">
					<p>Use contextual classes to color table rows.</p>
					<table class="table table-bordered table-striped">
						<colgroup>
							<col class="span1">
							<col class="span7">
						</colgroup>
						<thead>
							<tr>
								<th>Class</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<code>.success</code>
								</td>
								<td>Indicates a successful or positive action.</td>
							</tr>
							<tr>
								<td>
									<code>.error</code>
								</td>
								<td>Indicates a dangerous or potentially negative action.</td>
							</tr>
							<tr>
								<td>
									<code>.warning</code>
								</td>
								<td>Indicates a warning that might need attention.</td>
							</tr>
							<tr>
								<td>
									<code>.info</code>
								</td>
								<td>Used as an alternative to the default styles.</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="span8">
					<div class="example">
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>Product</th>
									<th>Payment Taken</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<tr class="success">
									<td>1</td>
									<td>TB - Monthly</td>
									<td>01/04/2012</td>
									<td>Approved</td>
								</tr>
								<tr class="error">
									<td>2</td>
									<td>TB - Monthly</td>
									<td>02/04/2012</td>
									<td>Declined</td>
								</tr>
								<tr class="warning">
									<td>3</td>
									<td>TB - Monthly</td>
									<td>03/04/2012</td>
									<td>Pending</td>
								</tr>
								<tr class="info">
									<td>4</td>
									<td>TB - Monthly</td>
									<td>04/04/2012</td>
									<td>Call in to confirm</td>
								</tr>
							</tbody>
						</table>
					</div>
					<pre class="prettyprint linenums">
&lt;tr class="success"&gt;
  &lt;td&gt; ... &lt;/td&gt;
&lt;/tr&gt;</pre>
				</div>
			</div>

			<h2>Pricing Tables</h2>
			<div class="row">
				<div class="span4">
					<p>If you're making a rockin' marketing site for a subscription-based product, you are likely in need of a pricing table. These fill 100% of their container and are made from a simple unordered list.</p>
				</div>
				<div class="span8">
					<div class="example">
						<ul class="pricing-table">
							<li class="title">Standard</li>
							<li class="price">$99.99</li>
							<li class="description">An awesome description</li>
							<li class="bullet-item">1 Database</li>
							<li class="bullet-item">5GB Storage</li>
							<li class="bullet-item">20 Users</li>
							<li class="price-button"><a class="btn btn-primary" href="#">Buy Now</a></li>
						</ul>
					</div>
					<pre class="prettyprint linenums">
&lt;ul class="pricing-table"&gt;
	&lt;li class="title"&gt;Standard&lt;/li&gt;
	&lt;li class="price"&gt;$99.99&lt;/li&gt;
	&lt;li class="description"&gt;An awesome description&lt;/li&gt;
	&lt;li class="bullet-item"&gt;1 Database&lt;/li&gt;
	&lt;li class="bullet-item"&gt;5GB Storage&lt;/li&gt;
	&lt;li class="bullet-item"&gt;20 Users&lt;/li&gt;
	&lt;li class="cta-button"&gt;&lt;a class="btn" href="#"&gt;Buy Now&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;</pre>
				</div>
			</div>

		</section>



		<!-- Forms
		================================================== -->
		<section id="forms">
			<div class="page-header">
				<h1>Forms</h1>
			</div>
			<div class="row">
				<div class="span4">
					<h2>Flexible HTML and CSS</h2>
					<p>The best part about forms in Diamond is that all your inputs and controls look great no matter how you build them in your markup. No superfluous HTML is required, but we provide the patterns for those who require it.</p>
					<p>More complicated layouts come with succinct and scalable classes for easy styling and event binding, so you're covered at every step.</p>
				</div>
				<div class="span4">
					<h2>Four layouts included</h2>
					<p>Diamond comes with support for four types of form layouts:</p>
					<ul>
						<li>Vertical (default)</li>
						<li>Search</li>
						<li>Inline</li>
						<li>Horizontal</li>
					</ul>
					<p>Different types of form layouts require some changes to markup, but the controls themselves remain and behave the same.</p>
				</div>
				<div class="span4">
					<h2>Control states and more</h2>
					<p>Diamond's forms include styles for all the base form controls like input, textarea, and select you'd expect. But it also comes with a number of custom components like appended and prepended inputs and support for lists of checkboxes.</p>
					<p>States like error, warning, and success are included for each type of form control. Also included are styles for disabled controls.</p>
				</div>
			</div>

			<h2>Four types of forms</h2>
			<p>Diamond provides simple markup and styles for four styles of common web forms.</p>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Name</th>
						<th>Class</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>Vertical (default)</th>
						<td><code>.form-vertical</code> <span class="muted">(not required)</span></td>
						<td>Stacked, left-aligned labels over controls</td>
					</tr>
					<tr>
						<th>Inline</th>
						<td><code>.form-inline</code></td>
						<td>Left-aligned label and inline-block controls for compact style</td>
					</tr>
					<tr>
						<th>Search</th>
						<td><code>.form-search</code></td>
						<td>Extra-rounded text input for a typical search aesthetic</td>
					</tr>
					<tr>
						<th>Horizontal</th>
						<td><code>.form-horizontal</code></td>
						<td>Float left, right-aligned labels on same line as controls</td>
					</tr>
				</tbody>
			</table>


			<h2>Example forms <small>using just form controls, no extra markup</small></h2>
			<div class="row">
				<div class="span4">
					<h3>Basic form</h3>
					<p>With v2.0, we have lighter and smarter defaults for form styles. No extra markup, just form controls.</p>
				</div>
				<div class="span8">
					<div class="example">
						<form>
							<fieldset>
								<legend>Legend</legend>
								<label>Label name <abbr title="Required">*</abbr></label>
								<input type="text" class="span3" placeholder="Type something..."> <span class="help-inline">Associated help text!</span>
								<span class="help-block">Example block-level help text here.</span>
								<label class="checkbox">
									<input type="checkbox"> Check me out
								</label>
								<button type="submit" class="btn">Submit</button>
							</fieldset>
						</form>
					</div>
					<pre class="prettyprint linenums">
&lt;form&gt;
  &lt;fieldset&gt;
    &lt;label&gt;Label name &lt;abbr title="Required"&gt;*&lt;/abbr&gt;&lt;/label&gt;
    &lt;input type="text" class="span3" placeholder="Type something..."&gt;
    &lt;span class="help-inline"&gt;Associated help text!&lt;/span&gt;
    &lt;label class="checkbox"&gt;
      &lt;input type="checkbox"&gt; Check me out
    &lt;/label&gt;
    &lt;button type="submit" class="btn"&gt;Submit&lt;/button&gt;
  &lt;/fieldset&gt;
&lt;/form&gt;</pre>
				</div>
			</div> <!-- /row -->
			<div class="row">
				<div class="span4">
					<h3>Search form</h3>
					<p>Reflecting default WebKit styles, just add <code>.form-search</code> for extra rounded search fields.</p>
				</div>
				<div class="span8">
					<div class="example">
						<form class="form-search">
							<input type="text" class="input-medium search-query">
							<button type="submit" class="btn">Search</button>
						</form>
					</div>
					<pre class="prettyprint linenums">
&lt;form class="form-search"&gt;
  &lt;input type="text" class="input-medium search-query"&gt;
  &lt;button type="submit" class="btn"&gt;Search&lt;/button&gt;
&lt;/form&gt;</pre>
				</div>
			</div> <!-- /row -->
			<div class="row">
				<div class="span4">
					<h3>Inline form</h3>
					<p>Inputs are block level to start. For <code>.form-inline</code> and <code>.form-horizontal</code>, we use inline-block.</p>
				</div>
				<div class="span8">
					<div class="example">
						<form class="form-inline">
							<input type="text" class="input-small" placeholder="Email">
							<input type="password" class="input-small" placeholder="Password">
							<label class="checkbox">
								<input type="checkbox"> Remember me
							</label>
							<button type="submit" class="btn">Sign in</button>
						</form>
					</div>
					<pre class="prettyprint linenums">
&lt;form class="form-inline"&gt;
  &lt;input type="text" class="input-small" placeholder="Email"&gt;
  &lt;input type="password" class="input-small" placeholder="Password"&gt;
  &lt;label class="checkbox"&gt;
    &lt;input type="checkbox"&gt; Remember me
  &lt;/label&gt;
  &lt;button type="submit" class="btn"&gt;Sign in&lt;/button&gt;
&lt;/form&gt;</pre>
				</div>
			</div><!-- /row -->

			<br>

			<h2>Horizontal forms</h2>
			<div class="row">
				<div class="span4">
					<p>Given the above example form layout, here's the markup associated with the first input and control group. The <code>.control-group</code>, <code>.control-label</code>, and <code>.controls</code> classes are all required for styling.</p>
					<h3>What's included</h3>
					<p>Shown on the left are all the default form controls we support. Here's the bulleted list:</p>
					<ul>
						<li>text inputs (text, password, email, etc)</li>
						<li>checkbox</li>
						<li>radio</li>
						<li>select</li>
						<li>multiple select</li>
						<li>file input</li>
						<li>textarea</li>
					</ul>
				</div>
				<div class="span8">
					<div class="example">
						<form class="form-horizontal">
							<div class="control-group">
								<label class="control-label" for="input01">Text input</label>
								<div class="controls">
									<input type="text" class="input-xlarge" id="input01">
									<p class="help-block">In addition to freeform text, any HTML5 text-based input appears like so.</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="optionsCheckbox">Checkbox</label>
								<div class="controls">
									<label class="checkbox">
										<input type="checkbox" id="optionsCheckbox" value="option1">
										Option one is this and that&mdash;be sure to include why it's great
									</label>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="select01">Select list</label>
								<div class="controls">
									<select id="select01">
										<option>something</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="multiSelect">Multicon-select</label>
								<div class="controls">
									<select multiple="multiple" id="multiSelect">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="fileInput">File input</label>
								<div class="controls">
									<input class="input-file" id="fileInput" type="file">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="textarea">Textarea</label>
								<div class="controls">
									<textarea class="input-xlarge" id="textarea" rows="3"></textarea>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="textarea">Textarea (class <code>.small</code>)</label>
								<div class="controls">
									<textarea class="input-xlarge small" id="textarea"></textarea>
								</div>
							</div>
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">Save changes</button>
								<button class="btn">Cancel</button>
							</div>
						</form>
					</div>
					<pre class="prettyprint linenums">
&lt;form class="form-horizontal"&gt;
  &lt;div class="control-group"&gt;
    &lt;label class="control-label" for="input01"&gt;Text input&lt;/label&gt;
    &lt;div class="controls"&gt;
      &lt;input type="text" class="input-xlarge" id="input01"&gt;
      &lt;p class="help-block"&gt;Supporting help text&lt;/p&gt;
    &lt;/div&gt;
  &lt;/div&gt;
&lt;/form&gt;</pre>
				</div>
			</div>

			<h2>Form control states</h2>
			<div class="row">
				<div class="span4">
					<h3>Redesigned browser states</h3>
					<p>Diamond features styles for browser-supported focused and <code>disabled</code> states. We remove the default Webkit <code>outline</code> and apply a <code>box-shadow</code> in its place for <code>:focus</code>.</p>
					<h3>Form validation</h3>
					<p>It also includes validation styles for errors, warnings, and success. To use, add the error class to the surrounding <code>.control-group</code>.</p>
				</div>
				<div class="span8">
					<div class="example">
						<form class="form-horizontal">
							<div class="control-group">
								<label class="control-label" for="focusedInput">Focused input</label>
								<div class="controls">
									<input class="input-xlarge focused" id="focusedInput" type="text" value="This is focused...">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Uneditable input</label>
								<div class="controls">
									<span class="input-xlarge uneditable-input">Some value here</span>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="disabledInput">Disabled input</label>
								<div class="controls">
									<input class="input-xlarge disabled" id="disabledInput" type="text" placeholder="Disabled input here..." disabled>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="optionsCheckbox2">Disabled checkbox</label>
								<div class="controls">
									<label class="checkbox">
										<input type="checkbox" id="optionsCheckbox2" value="option1" disabled>
										This is a disabled checkbox
									</label>
								</div>
							</div>
							<div class="control-group warning">
								<label class="control-label" for="inputWarning">Input with warning</label>
								<div class="controls">
									<input type="text" id="inputWarning">
									<span class="help-inline">Something may have gone wrong</span>
								</div>
							</div>
							<div class="control-group error">
								<label class="control-label" for="inputError">Input with error</label>
								<div class="controls">
									<input type="text" id="inputError">
									<span class="help-inline">Please correct the error</span>
								</div>
							</div>
							<div class="control-group success">
								<label class="control-label" for="inputSuccess">Input with success</label>
								<div class="controls">
									<input type="text" id="inputSuccess">
									<span class="help-inline">Woohoo!</span>
								</div>
							</div>
							<div class="control-group success">
								<label class="control-label" for="selectError">Select with success</label>
								<div class="controls">
									<select id="selectError">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
									<span class="help-inline">Woohoo!</span>
								</div>
							</div>
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">Save changes</button>
								<button class="btn">Cancel</button>
							</div>
						</form>
					</div>
					<pre class="prettyprint linenums">
&lt;fieldset
  class="control-group error"&gt;
  ...
&lt;/fieldset&gt;</pre>
				</div>
			</div>

			<h2>Extending form controls</h2>
			<div class="row">
				<div class="span4">
					<h3>Form sizes</h3>
					<p>Use the same <code>.span*</code> classes from the grid system for input sizes.</p>
					<p>You may also use static classes that don't map to the grid, adapt to the responsive CSS styles, or account for varying types of controls (e.g., <code>input</code> vs. <code>select</code>).</p>
				</div>
				<div class="span8">
					<div class="example">
						<form class="form-horizontal">
							<div class="control-group">
								<label class="control-label">Grid sizes</label>
								<div class="controls docs-input-sizes">
									<input class="span1" type="text" placeholder=".span1">
									<br />
									<input class="span2" type="text" placeholder=".span2">
									<br />
									<input class="span3" type="text" placeholder=".span3">
									<br />
									<select class="span1">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
									<br />
									<select class="span2">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
									<br />
									<select class="span3">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Alternate sizes</label>
								<div class="controls docs-input-sizes">
									<input class="input-mini" type="text" placeholder=".input-mini">
									<input class="input-small" type="text" placeholder=".input-small">
									<input class="input-medium" type="text" placeholder=".input-medium">
								</div>
							</div>
						</form>
					</div>
					<pre class="prettyprint linenums">
&lt;input class="span2" type="text" value="..." /&gt;
&lt;input class="input-small" type="text" value="..." /&gt;
&lt;select class="span3"&gt; ... &lt;/select&gt;
&lt;select class="input-mini"&gt; ... &lt;/select&gt;</pre>
				</div>
			</div>
			<div class="row">
				<div class="span4">

					<h3>Prepend &amp; append inputs</h3>
					<p>Input groups&mdash;with appended or prepended text&mdash;provide an easy way to give more context for your inputs. Great examples include the @ sign for Twitter usernames or $ for finances.</p>
					<p>To use prepend or append inputs in an inline form, be sure to place the <code>.add-on</code> and <code>input</code> on the same line, without spaces.</p>
				</div>
				<div class="span8">
					<div class="example">
						<form class="form-horizontal">
							<div class="control-group">
								<label class="control-label" for="prependedInput">Prepended text</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on">@</span><input class="span2" id="prependedInput" size="16" type="text">
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="appendedInput">Appended text</label>
								<div class="controls">
									<div class="input-append">
										<input class="span2" id="appendedInput" size="16" type="text"><span class="add-on">.00</span>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="appendedPrependedInput">Append and prepend</label>
								<div class="controls">
									<div class="input-prepend input-append">
										<span class="add-on">$</span><input class="span2" id="appendedPrependedInput" size="16" type="text"><span class="add-on">.00</span>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="appendedPrependedInput">Append with button</label>
								<div class="controls">
									<div class="input-append">
										<input class="span2" id="appendedPrependedInput" size="16" type="text"><button class="btn" type="button">Go!</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<pre class="prettyprint linenums">
&lt;div class="controls"&gt;
  &lt;div class="input-prepend"&gt;
    &lt;span class="add-on"&gt;$&lt;/span&gt;&lt;input type="text" value="..." /&gt;
  &lt;/div&gt;
&lt;/div&gt;

&lt;div class="controls"&gt;
  &lt;div class="input-append"&gt;
   &lt;input type="text" value="..." /&gt;&lt;span class="add-on"&gt;.00&lt;/span&gt;
  &lt;/div&gt;
&lt;/div&gt;

&lt;div class="controls"&gt;
  &lt;div class="input-append"&gt;
   &lt;input type="text" value="..." /&gt;&lt;button class="btn" type="button"&gt;Go!&lt;/button&gt;
  &lt;/div&gt;
&lt;/div&gt;</pre>
				</div>
			</div>
			<div class="row">
				<div class="span4">

					<h3>Help text</h3>
					<p>To add help text for your form inputs, include inline help text with <code>&lt;span class="help-inline"&gt;</code> or a help text block with <code>&lt;p class="help-block"&gt;</code> after the input element.</p>
				</div>
				<div class="span8">
					<div class="example">
						<form class="form-horizontal">
							<div class="control-group">
								<label class="control-label" for="prependedInput">Help block</label>
								<div class="controls">
									<input class="span2" id="helpBlockInput" size="16" type="text">
									<p class="help-block">Here's some help text</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="appendedInput">Help inline</label>
								<div class="controls">
									<input class="span2" id="helpInlineInput" size="16" type="text">
									<span class="help-inline">Here's more help text</span>
								</div>
							</div>
						</form>
					</div>
					<pre class="prettyprint linenums">
&lt;div class="controls"&gt;
  &lt;input type="text" value="..." /&gt;
  &lt;p class="help-block"&gt; ... &lt;/p&gt;
&lt;/div&gt;

&lt;div class="controls"&gt;
  &lt;input type="text" value="..." /&gt;
  &lt;span class="help-inline"&gt; ... &lt;/span&gt;
&lt;/div&gt;</pre>

				</div>
			</div>
			<div class="row">
				<div class="span4">
					<h3>Inline checkboxes</h3>
					<p>Inline checkboxes and radios are also supported. Just add <code>.inline</code> to any <code>.checkbox</code> or <code>.radio</code> and you're done.</p>
				</div>
				<div class="span8">
					<div class="example">
						<form class="form-horizontal">
							<div class="control-group">
								<label class="control-label" for="inlineCheckboxes">Inline checkboxes</label>
								<div class="controls">
									<label class="checkbox inline">
										<input type="checkbox" id="inlineCheckbox1" value="option1"> 1
									</label>
									<label class="checkbox inline">
										<input type="checkbox" id="inlineCheckbox2" value="option2"> 2
									</label>
									<label class="checkbox inline">
										<input type="checkbox" id="inlineCheckbox3" value="option3"> 3
									</label>
								</div>
							</div>
						</form>
					</div>
					<pre class="prettyprint linenums">
&lt;div class="controls"&gt;
  &lt;label class="checkbox inline"&gt;
    &lt;input type="checkbox" value="option1" /&gt; 1
  &lt;/label&gt;
&lt;/div&gt;</pre>
				</div>
			</div>
			<div class="row">
				<div class="span4">
					<h3>Form actions</h3>
					<p>End a form with a group of actions (buttons). When placed within a <code>.form-actions</code>, the buttons will automatically indent to line up with the form controls.</p>
				</div>
				<div class="span8">
					<div class="example">
						<form class="form-horizontal">
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">Save changes</button>
								<button class="btn">Cancel</button>
							</div>
						</form>
					</div>
					<pre class="prettyprint linenums">
&lt;div class="form-actions"&gt;
    &lt;button type="submit" class="btn btn-primary" /&gt;Save&lt;/button&gt;
    &lt;button class="btn" /&gt;Cancel&lt;/button&gt;
&lt;/div&gt;</pre>

				</div>
			</div><!-- /row -->
		</section>

		<!-- Images
		================================================== -->
		<section id="images">
			<div class="page-header">
				<h1>Images</h1>
			</div>
			<div class="row">
				<div class="span4">
					<p>Add classes to an <code>&lt;img&gt;</code> element to easily style images in any project.</p>
				</div>
				<div class="span8">
					<div class="example">
						<img src="assets/img/140x140.png" class="img-rounded" alt="140x140" style="width: 140px; height: 140px;">
						<img src="assets/img/140x140.png" class="img-circle" alt="140x140" style="width: 140px; height: 140px;">
						<img src="assets/img/140x140.png" class="img-polaroid" alt="140x140" style="width: 140px; height: 140px;">
					</div>
					<pre class="prettyprint linenums">
&lt;img src="..." class="img-rounded"&gt;
&lt;img src="..." class="img-circle"&gt;
&lt;img src="..." class="img-polaroid"&gt;</pre>
				</div>
			</div>
		</section>



		<!-- Colors
		================================================== -->
		<section id="colors">
			<div class="page-header">
				<h1>Colors <small>All the colors that are used in this Diamond</small></h1>
			</div>
			<div class="row">
				<div class="span4">
					<p>You can use the colors as text color by adding <code>.txt-colorname</code> to the class or as background color <code>.bg-colorname</code> or as border color <code>.border-colorname</code></p>
				</div>
				<div class="span8">
					<div class="example the-colors">
						<div class="bg-yellowlight txt-bluedark border-purple" style="border-style: solid; border-width: 1px;">Some text... </div>
					</div>
					<pre class="prettyprint linenums">&lt;div class="bg-yellowlight txt-bluedark border-purple"&gt; ... &lt;/div&gt;</pre>
				</div>
			</div>
			<div class="row">
				<div class="span12">
					<div class="row">
						<div class="span4">
							<h3>Grayscale</h3>
							<p>There are 8 tints from white to black</p>
							<div class="row">
								<div class="span2 the-colors">
									<h4>Dark</h4>
									<div class="bg-black txt-white">black</div>
									<div class="bg-graydarker txt-white">graydarker</div>
									<div class="bg-graydark txt-white">graydark</div>
									<div class="bg-gray txt-white">gray</div>
								</div>
								<div class="span2 the-colors">
									<h4>Light</h4>
									<div class="bg-graylight">graylight</div>
									<div class="bg-graylighter">graylighter</div>
									<div class="bg-graybright">graybright</div>
									<div class="bg-white">white</div>
								</div>
							</div>
						</div>
						<div class="span8">
							<h3>Rainbows</h3>
							<p>For each color you have a normal color tint, a light and a dark.</p>
							<div class="row">
								<div class="span2 the-colors">
									<h4>Blue</h4>
									<div class="bg-bluelight txt-white">bluelight</div>
									<div class="bg-blue txt-white">blue</div>
									<div class="bg-bluedark txt-white">bluedark</div>
								</div>
								<div class="span2 the-colors">
									<h4>Green</h4>
									<div class="bg-greenlight txt-white">greenlight</div>
									<div class="bg-green txt-white">green</div>
									<div class="bg-greendark txt-white">greendark</div>
								</div>
								<div class="span2 the-colors">
									<h4>Red</h4>
									<div class="bg-redlight txt-white">redlight</div>
									<div class="bg-red txt-white">red</div>
									<div class="bg-reddark txt-white">reddark</div>
								</div>
								<div class="span2 the-colors">
									<h4>Yellow</h4>
									<div class="bg-yellowlight">yellowlight</div>
									<div class="bg-yellow">yellow</div>
									<div class="bg-yellowdark">yellowdark</div>
								</div>
							</div>
							<div class="row">
								<div class="span2 the-colors">
									<h4>Orange</h4>
									<div class="bg-orangelight txt-white">orangelight</div>
									<div class="bg-orange txt-white">orange</div>
									<div class="bg-orangedark txt-white">orangedark</div>
								</div>
								<div class="span2 the-colors">
									<h4>Pink</h4>
									<div class="bg-pinklight txt-white">pinklight</div>
									<div class="bg-pink txt-white">pink</div>
									<div class="bg-pinkdark txt-white">pinkdark</div>
								</div>
								<div class="span2 the-colors">
									<h4>Purple</h4>
									<div class="bg-purplelight txt-white">purplelight</div>
									<div class="bg-purple txt-white">purple</div>
									<div class="bg-purpledark txt-white">purpledark</div>
								</div>
								<div class="span2 the-colors">
									<h4>Fushia</h4>
									<div class="bg-fushialight txt-white">fushialight</div>
									<div class="bg-fushia txt-white">fushia</div>
									<div class="bg-fushiadark txt-white">fushiadark</div>
								</div>
							</div>
							<div class="row">
								<div class="span2 the-colors">
									<h4>Lila</h4>
									<div class="bg-lilalight">lilalight</div>
									<div class="bg-lila txt-white">lila</div>
									<div class="bg-liladark txt-white">liladark</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

	</div><!-- /container -->

</div>
<?php $this->load->view('diamond/footer'); ?>
