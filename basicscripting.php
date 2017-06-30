<!DOCTYPE html>
<html>

  <head>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="description" content="MDsrv : MD trajectory server">

    <link rel="stylesheet" type="text/css" media="screen" href="stylesheets/stylesheet.css">
		<style>
      table, td, th { border: 0 solid black; }
    </style>
    <title>MDsrv</title>
  </head>

  <body>


<!-- HEADER AND SIDEBAR -->
<?php include 'include/headerSide.php';?>

<div class="content">



<h2>Simple script example</h2>

<pre><code>var basePath = "cwd/data/";
var sysPath = "file://" + basePath + "md_1u19.gro";
stage.loadFile( sysPath ).then( function( comp ){
    comp.addRepresentation( "cartoon" );
    comp.addTrajectory( basePath  + "md_1u19.xtc" );
} );</code></pre>

<p align=justify>This script example is partly extracted from the sample <a target="_blank" href="data/script.ngl">.ngl file</a>. It loades a structure (<em>structure.gro</em>) file with the <em>cartoon</em> representation and a simulation (<em>sim.xtc</em>) into the NGL Viewer.</p>
<br>

<pre><code>var trajSele = {
	sele: "backbone and not #h", initialFrame: -1,
	centerPdb: true, removePbc: true, superpose: true;
	defaultTimeout: 20, defaultStep: 3
};
comp.addRepresentation( "licorice", { visible: false } );
comp.addTrajectory( basePath  + "@md_1u19.xtc", trajSele );</code></pre>

<p align=justify>Trajectories can have different configurations. Some default values are displayed above, others are changed accordingly to the simulation. -1 for the initial frame referes to the conformation of the structure file. To load several parts of a continuous simulation (<em>md_1u19.part0001.xtc, md_1u19.part0002, ... </em>), add the <em>@ symbol</em> before the name of the trajectory. This is especially usefull if you inspect unprocessed trajectories.</p>
<br>
<pre><code>panel.setName( "A simple example" );
stage.setParameters( { backgroundColor: "white", hoverTimeout: -1 } );</code></pre>

<p align=justify>The panel (see also the <a href="usage.html#gui">NGL GUI guide</a>) can be named and several stage options are available. Here we present how to change the background colour and how to disable the mouse visualization option - for more please consult the <a href="http://arose.github.io/ngl/api/index.html">NGL documentation</a>.</p>
<br>

<h2>Basic functions</h2>


<pre><code>var h = scriptHelperFunctions(stage, panel)
h.uiButton(
    "reverse view",
    function(){
        stage.eachComponent( function( comp ){
            if (comp.visible === true){
                h.visible( false, comp );
            }else{
                h.visible( true, comp );
            }
        } );
    }
);
h.uiButton(
    "sidechains on/off",
    function(){
        h.representations( "licorice" ).list.forEach( function( repre ){
            h.visible(!repre.visible, repre);
        } );
    }
);</code></pre>

<p align=justify>In order to generate clickable functions for session-like behaviour, a class (<em>scriptHelperFunctions</em>) has to be included. The first function "reverse view" changes for each component within the session the visibility, the second function "sidechains on/off" changes for each licorice representation of every component within the session the visibility. With these two functions, you can change component and representation features.</p>


<h2>Complete script</h2>
<p align=justify>All functions and script snipplets explained above are collected within a script, presented below and downloadable <a target="_blank" href="data/script.ngl">here</a>. The ending of the file can be ".ngl" or ".js".</p>

<pre><code>panel.setName( "A simple example" );
stage.setParameters( { backgroundColor: "white", hoverTimeout: -1 } );
var h = scriptHelperFunctions(stage, panel)
h.uiButton(
    "reverse view",
    function(){
        stage.eachComponent( function( comp ){
            if (comp.visible === true){
                h.visible( false, comp );
            }else{
                h.visible( true, comp );
            }
        } );
    }
);
h.uiButton(
    "sidechains on/off",
    function(){
        h.representations( "licorice" ).list.forEach( function( repre ){
            h.visible(!repre.visible, repre);
        } );
    }
);

//Function to load a structure & two trajectories individually
var trajSele = {
    sele: "backbone and not #h", initialFrame: -1, centerPdb: true,
    removePbc: ture, superpose: true; defaultTimeout: 20, defaultStep: 3
    };
var basePath = "cwd/data/";
var sysPath = "file://" + basePath + "md_1u19.gro";
stage.loadFile( sysPath ).then( function( comp ){
    comp.addRepresentation( "cartoon" );
		comp.addRepresentation( "licorice", {visible: false} );
    comp.addTrajectory( basePath  + "md_1u19.xtc", trajSele );
    comp.addTrajectory( basePath  + "/@md_1u19.xtc", trajSele );
    comp.centerView();
} );</code></pre>

<h1>
<a id="more" class="anchor" href="#more" aria-hidden="true"><span aria-hidden="true" class="octicon octicon-link"></span></a>More</h1>

<p>If you have question, feel free to use the
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
