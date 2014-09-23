# Getting started - How to create a custom theme

This is the start of a new blog series where we introduce the capabilities of the Piwik platform. You'll learn how to write custom plugins &amp; themes, how to use our HTTP APIs and more.

We have been greatly simplifying our APIs over the last year focusing primarily on one design principle:

<blockquote style="margin-bottom: 50px">The complexity of our API should never exceed the complexity of your use case.</blockquote>

In other words, if you have a simple use for our API, we want it to be simple for you to accomplish it. If you have a complex, big, hairy, change-the-world idea, then maybe we can't make it simple for you to accomplish it, but we want it to be <strong><em>possible</em></strong>.

Over the next weeks and months you will learn what exactly we mean by this and how we accomplished it.

FYI, don't worry if you're currently using our APIs, we keep them backwards compatible and we announce breaking changes in our <a target="_blank" href="http://developer.piwik.org/changelog">platform changelog</a>.

<h2>Getting started</h2>

In this series of posts, we assume that you have already set up your development environment. If not, visit the <a target="_blank" href="http://developer.piwik.org">Piwik Developer Zone</a> where you'll find the tutorial <a target="_blank" href="http://developer.piwik.org/guides/getting-started-part-1">Setting up Piwik</a>.

To summarize the things you have to do to get setup:
<ul>
<li style="margin-bottom: 10px">Install Piwik (for instance via git).</li>
<li style="margin-bottom: 10px">Activate the developer mode: <code style="color:#C5C8C6">./console development:enable --full</code>.</li>
<li style="margin-bottom: 10px">And if you want, generate some test data: <code style="color:#C5C8C6">./console visitorgenerator:generate-visits --idsite=1 --limit-fake-visits=600</code>. This can take a while and requires the VisitorGenerator plugin from the Marketplace.</li>
</ul>

<h2>Let's start creating our own theme</h2>

We start by using the <a target="_blank" href="http://developer.piwik.org/guides/piwik-on-the-command-line">Piwik Console</a> to create a blank theme:

<pre><code>./console generate:theme</code></pre>

The command will ask you to enter a name, description and version number for your theme. I will simply use "CustomTheme" as the name of the theme. There should now be a folder <code style="color:#C5C8C6">plugins/CustomTheme</code> which contains some files to get you started easily. 

Before we modify our theme, we have to activate it by visiting the <span style="font-variant: small-caps">Settings =&gt; Themes</span> admin page in our Piwik installation, or alternatively by running the command <code style="color:#C5C8C6">./console core:plugin activate YourCustomTheme</code>. If the theme is not activated, we won't see any changes.

<h3>Theme Contents</h3>
The most important files in our theme are <code style="color:#C5C8C6">plugins/CustomTheme/stylesheets/theme.less</code>, <code style="color:#C5C8C6">plugins/CustomTheme/stylesheets/_colors.less</code> and <code style="color:#C5C8C6">plugins/CustomTheme/stylesheets/_variables.less</code>:

<ul>
<li style="margin-bottom: 10px"><code style="color:#C5C8C6">theme.less</code> is the file that will be included when your theme is activated. In this file you would include other stylesheet files and overwrite CSS styles.</li>
<li style="margin-bottom: 10px"><code style="color:#C5C8C6">_colors.less</code> contains many <a target="_blank" href="http://lesscss.org/">less</a> variables allowing you to easily change the colors Piwik uses.</li>
<li style="margin-bottom: 10px"><code style="color:#C5C8C6">_variables.less</code> contains currently only one variable to change the font family. More variables will be added in the future. Note: This is a new feature and the file will be only there in case you have installed Piwik using Git or at least Piwik 2.6.0.</li>
</ul>

<h3>Changing the font family</h3>
To change the font family simply overwrite the variable <code style="color:#C5C8C6">@theme-fontFamily-base: Verdana, sans-serif;</code> in <code style="color:#C5C8C6">_variables.less</code>. That's it.

<h3>Changing colors</h3>
To change a color, uncomment the less variables of the colors you want to change in <code style="color:#C5C8C6">_colors.less</code>. I will shortly explain some of them. Usually changing only these colors will be enough to adjust Piwik's look to your corporate design or to create a look that pleases you:

<pre><code>@theme-color-brand:                    #d4291f; // The Piwik red which is for instance used in the menu, it also defines the color of buttons, the little arrows and more
@theme-color-brand-contrast:           #ffffff; // Contrast color to the Piwik red. Usually you need to change it only in case you define a light brand color. For instance to change the text color of buttons
@theme-color-link:                     #1e93d1; // The link color which is usually a light blue

@theme-color-widget-title-text:        #0d0d0d; // The text and background color of the header of a widget (Dashboard)
@theme-color-widget-title-background:  #f2f2f2;

@theme-color-menu-contrast-text:       #666666; // The text color of a menu item in the reporting sub menu and the admin menu
@theme-color-menu-contrast-textActive: #0d0d0d; // The text color of an active menu item
@theme-color-menu-contrast-background: #f2f2f2; // The background color of a menu item

@graph-colors-data-series[1-8]:        #000000; // The different colors used in graphs</code></pre>

<h3>Making the change visible</h3>
To make a color or font change actually visible when you reload a page in Piwik you will have to delete the compiled CSS file after each change like this:

<pre><code>rm tmp/assets/asset_manager_global_css.css</code></pre>

<h3>Publishing your Theme on the Marketplace</h3>
In case you want to share your theme with other Piwik users you can do this by <a href="http://developer.piwik.org/guides/distributing-your-plugin#put-your-plugin-on-github" target="_blank">pushing</a> your theme to GitHub and <a href="http://developer.piwik.org/guides/distributing-your-plugin#publish-the-first-version-of-your-plugin" target="_blank">creating a tag</a>. Easy as that. Read more about how to <a target="_blank" href="http://developer.piwik.org/guides/distributing-your-plugin">distribute a theme</a>.

<h2>Advanced features</h2>
Isn't it easy to create a custom theme? All we had to do is to change some less variables. We never even created a file! Of course, based on our API design principle, you can accomplish more if you want. For instance, you can change icons, CSS stylesheets, templates and more. 

For further customising your Piwik, you can even <a target="_blank" href="http://piwik.org/faq/new-to-piwik/faq_129/">change the logo and favicon</a> in the <span style="font-variant: small-caps">Settings =&gt; General settings</span> page.

Would you like to know more about theming? Go to our <a target="_blank" href="http://developer.piwik.org/guides/theming">Theme guide</a> in the Piwik Developer Zone.

If you have any feedback regarding our APIs or our guides in the Developer Zone feel free to <a target="_blank" href="mailto:developer@piwik.org"><strong>send it to us</strong></a>.

PS: see also this related FAQ: <a href='http://piwik.org/faq/how-to/faq_170/'>How do I White Label Piwik?</a>
