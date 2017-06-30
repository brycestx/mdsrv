<!DOCTYPE html>
<html>

  <head>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="description" content="MDsrv : MD trajectory server">

    <link rel="stylesheet" type="text/css" media="screen" href="stylesheets/stylesheet.css">

    <title>MDsrv</title>
  </head>

  <body>

<!-- HEADER AND SIDEBAR -->
<?php include 'include/headerSide.php';?>

<div class="content">


<h2><a id="local" class="anchor" href="#local" aria-hidden="true"><span aria-hidden="true" class="octicon octicon-link"></span></a>Local usage</h2>

<p align=justify>Within a local environment, for short-time usage or testing, the MDsrv can be started from a directory providing access to files within this and underlying directories by the following command:</p>

<pre><code>> mdsrv</code></pre>

<pre><code>positional options: [structure] [trajectory]
additional options: [--script SCRIPT] [--cfg CFG]
                    [--host HOST] [--port PORT]</code></pre>

<p align=justify>The command <em>"mdsrv"</em> itself starts the MDsrv including the NGL viewer with access to files within the starting directory and underneath, exclusively. By executing the MDsrv with a structure (e.g. a .gro or .pdb file) and trajectory (e.g. a .gro, .xtc or .dcd file) including their path which must be within the current working directory or a sub directory, both will be loaded into the MD viewer.</p>
<pre><code>> mdsrv 3DQB.gro sims/3DQB.xtc       <-- working
> mdsrv 3DQB.gro ../../3DQB.xtc      <-- not working (parent directory not accessible)
</code></pre>
<p align=justify>A structure file is mandatory for loading a trajectory. Trajectories and structures within the current working directory can still be loaded afterwards via the GUI.</p> 
<p align=justify>
MDsrv uses <a target="_blank" href="data/script.ngl">.ngl/.js</a> script files to load structures and trajectories with specific settings (e.g representations, colors, selections or background scheme), orientations or self-coded functions. The file is further explained below and example code can be found in the <a href="scripting.html">scripting section</a>.
</p>
<pre><code>mdsrv --script session.ngl
mdsrv --script session.js
</code></pre>
<p align=justify>The .ngl file is written in JavaScript and contains commands to execute predefined settings and functions. A sample <a target="_blank" href="data/script.ngl">.ngl file</a> shows additional options like functions and basic loading commands. This is recommended if simulation sessions should be shared. The location of this file should be within an accessible directory and can then be loaded via the URL (e.g. <em>http://localhost/mdsrv.html?load=file://MDsrv/example.ngl</em>, where MDsrv is the directory defined within the <a target="_blank" href="data/app.cfg">.cfg file</a>). Further information and example code can be found in the <a href="scripting.html">scripting</a> section.</p>


<p align=justify>
To include other directories and security settings, the configuration file (<a target="_blank" href="data/app.cfg">.cfg</a>, explained in the <a href="configuration.html">configuration section</a>) can be loaded accordingly:
<pre><code>mdsrv --cfg my.cfg
mdsrv --configure my.cfg
</code></pre>
</p>
<br>

<h2>System wide/web-server usage</h2>

<p align=justify>To maintain MDsrv as a system wide web-server, follow the <a href="deployment.html">deployment instructions</a>. Besides apache, any webserver with wsgi support can be used (not tested).</p>
<p align=justify>We provide an  <a target="_blank" href="http://proteinformatics.charite.de/MDsrv-example">example</a> of the usage of the MDsrv as a web-server in combination with the <a target="_blank" href="https://github.com/arose/ngl">NGL viewer</a>. An embedded example is used in this <a href="index.html">documentation</a>. By utilizing a web-server, collaborators, reviewers or students can easily inspect simulations visually on-the-fly.
</p>
<br>

<h2><a id="gui" class="anchor" href="#gui" aria-hidden="true"><span aria-hidden="true" class="octicon octicon-link"></span></a>NGL GUI guide</h2>
 <img src="data/gui.png" width=100% alt="NGL GUI">
 
 <h4>Loading simulations</h4>
<p align=justify>Simulations can be loaded in several different ways into the NGL GUI. To load simulations into the <a target="_blank" href="https://github.com/arose/ngl">NGL viewer</a>, a structure file has to be provided first. Structure and .ngl scripting files can be loaded by drag&drop into the viewer or by browsing through the folders by clicking <em>File --> Import</em> <strong>(A, B, C)</strong>.</p>

<p align=justify>
Within the structure menu, several trajectories can be imported via <em>Trajectory import</em> for autoloadable trajectories (currently dcd files supported, xtc under development) or <em>Remote trajectory --> Import</em> for deposed trajectories <strong>(D, E)</strong>.</p>

<p align=justify>If you want to load a trajectory containing already all atomistic information (e.g. .gro trajectories), select <em>File --> as trajectory</em> <strong>(A, B)</strong> before loading the file. This flag is set until it is removed. Then load the file as previously described via drag&drop or through the folders.</p>

<h4>Simulation settings</h4>
<p align=justify>The content of the simulation can be specified through the <em>filter selection</em> (e.g. <em>"protein and not #h"</em>). Within the trajectory menu <strong>(F)</strong>, the simulation can be further adjusted (e.g. centering, superposing, removing PBC, step sizes or play options).</p>

<br>

<h1>
<a id="more" class="anchor" href="#more" aria-hidden="true"><span aria-hidden="true" class="octicon octicon-link"></span></a>More</h1>

<p>If you have questions, feel free to use the
<a target="_blank" href="https://github.com/arose/mdsrv/issues">Issue Tracker</a> or write a mail to
<a href="mailto:johanna.tiemann@gmail.com">johanna.tiemann@gmail.com</a> or
<a href="mailto:alexander.rose@weirdbyte.de">alexander.rose@weirdbyte.de</a>.</p>

<p>Please give us <strong>feedback</strong>!</p>

    </div>
    </div>
    
<!-- FOOTER  -->
<?php include 'include/footer.php';?>




  </body>
</html>