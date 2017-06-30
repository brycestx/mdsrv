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


<br>
<p align=justify>Here we collected usefull functions, scripting example codes and definitions for more advanced scripting. This will be updated regularly. Please feel free to also drop an issue at GitHub or mail us!</p>



<h2>NGL codepen examples</h2>

<p align=justify>Within the NGL documentation, several examples have been made available for live testing and editing. Just have a look at the <a target="_blank" href="http://arose.github.io/ngl/gallery/index.html">gallery</a>, choose an example and change the <em>.js/.ngl</em> JavaScript file to visualize your changes.</p>

<h2>Loading files</h2>
<pre><code>var files = [ "md01" "md02" ];
var promiseList = [];
files.forEach( function( name ){
	promiseList.push( stage.loadFile(
		"file://cwd/data/" + name + ".gro", {name: name} )
  );
} );
Promise.all( promiseList ).then( function( objectList ){
	var compX;
	objectList.forEach( function( comp, i ){
		if( i === 0 ){
			compX = comp;
		}else{
			comp.superpose( compX, true );
		};
		comp.addRepresentation( "cartoon" );
		comp.addTrajectory( "cwd/data/" + comp.name + ".xtc" );
	} );
} );</code></pre>
<p align=justify>Within this code example, several files within a list will be loaded, superposed and trajectories will be added. The superpositioning has to be done before the trajectories are added.</p>
<br>
<pre><code>
//options for file loading:
stage.loadFile( "rcsb://1crn.mmtf", { * } );
* = defaultRepresentation: true, asTrajectory: true, firstModelOnly: true,
    cAlphaOnly: true, ...
</code></pre>

<h2>Button function collection</h2>

<pre><code>//helper functions:
var h = scriptHelperFunctions(stage, panel);
h.components( "3SN6" )          //= stage.getComponentsByName
h.representations( "licorice" ) //= stage.getRepresentationsByName
h.visible( false, comp );
h.hide( comp );
h.show( comp );
h.superpose( comp1, comp2, * ) //* = additional options: align, sele1, sele2
h.uiText()      //= add text to panel
h.uiBreak()     //= add newline to panel
h.uiButton()    //= add button with click option to panel</code></pre>

<p align=justify>Here we present a random selection of functions. For many, you might want to use the <em>scriptHelperFunctions</em> (here refered as <em>h</em>).</p><br>
<pre><code>h.uiButton(
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
);</code></pre>
<p align=justify>Hides all components/structures which are visible and shows all which are not.</p><br>
<pre><code>h.uiButton(
    "sidechains on/off",
    function(){
        h.representations( "licorice" ).list.forEach( function( repre ){
            h.visible(!repre.visible, repre);
        } );
    }
);</code></pre>
<p align=justify>Hides all licorice representations which are visible and shows all which are not. This can be easily changed for other representations or in combination with components only for specific ones.</p><br>
<pre><code>var hidden = false;
h.uiButton(
    "show/hide all",
    function(){
        stage.eachComponent( function( comp ){
            if (hidden === true){
                h.visible(true, comp);
            }else{
                h.visible(false, comp);
            }
        } );
        if (hidden === true){
            hidden = false;
        }else{
            hidden = true;
        }
    }
);</code></pre>
<p align=justify>This function hides and shows all structures.</p><br>




<h2>Functions for embedding</h2>
<pre><code>//options for trajectoryPlayer:
trajectoryPlayer( * );
* = basePath  + "/@md_1u19.xtc", { ... }
    "@md.xtc" //= concatenates all md.part001.xtc + md.part002.xtc + ...
Trajectory Options:
	start: 1, end: 200, step: 3, timeout: 20,
	mode: loop, interpolateType: "", 
	direction: forward, interpolateStep: 2
</code></pre>
<br>
<pre><code>var isSpinning = false;
var toggleSpinning = document.getElementById( "toggleSpinning" );
toggleSpinning.addEventListener( "click", function(){
    if( !isSpinning ){
        stage.setSpin( [ 0, 1, 0.5 ], 0.01 );
        isSpinning = true;
    }else if(isSpinning){
        stage.setSpin( null, null);
        isSpinning = false;
    }
} );</code></pre>
<p align=justify>This code lets the stage spinn around the center with the speed of 0.01 and the tilt/angle of 0, 1 and 0.5 for x, y and z coordinates.</p><br>

<pre><code>var toggleDownload = document.getElementById( "toggleDownload" );
toggleDownload.addEventListener( "click", function(){
    var newStructure = stage.getComponentsByName("3SN6.pdb").list[0].structure;
    var remarks = ["my new structure selection"];
    var pdbWriter = new NGL.PdbWriter( newStructure, {
        remarks: remarks
    } );
    pdbWriter.download( "TMH" );
} );</code></pre>

<p align=justify>This function generates a button with a download function. It has also to be added into the html script (see the <a target="_blank" href="embedded.html">embedded scripting chapter</a> for more an example how to do this).</p>


<h2>Trajectory specific options</h2>

<pre><code>//options for adding trajectory components:
comp.addTrajectory( * );
* = basePath  + "/@md_1u19.xtc", { sele: "protein", ... }
    "@md.xtc" //= concatenates all md.part001.xtc + md.part002.xtc + ...
Trajectory Options:
	sele: "backbone and not #h", initialFrame: [int],
	centerPdb: [false|true], removePbc: [true|false],
	superpose: [true|false], defaultTimeout: [int],
	defaultStep: [int], defaultMode: ["loop"|"once"],
	defaultDirection: ["forward"|"backward"],
	defaultInterpolateStep: [int], 
	defaultInterpolateType: ["none"|"linear"|"spline"]
</code></pre>
<p align=justify>Brackets only for presenting the options.</p>


<h2>Further functions</h2>

<pre><code>trajComp.signals.frameChanged.add(function(){
	/* manually set selection */
} )</code></pre>
<p align=justify>To make selections or update e.g. text when a frame changed.</p><br>


<pre><code>setTimeout(myfunc2, 10000);
function myfunc2(){
	stage.setOrientation([
         [26.626668106519364,43.03096570969528,19.286422037346785],
         [23.941559483086454,23.435509540438492,32.25882758784041],
         [0.4788234882332539,0.43805461490045916,0.7608128688980521]])
}</code></pre>
<p align=justify>With this workaround, the orientation is set after a certain time.</p><br>


<pre><code>//This code selects all atoms within a certain radius and represents not only 
//this atoms but its corresponding residue.
stage.loadFile( "rcsb://3pqr" ).then( function( o ){
    // get all atoms within 5 Angstrom of retinal
    var selection = new NGL.Selection( "RET" );
    var radius = 5;
    var atomSet = o.structure.getAtomSetWithinSelection( selection,
    radius );
    // expand selection to complete groups
    var atomSet2 = o.structure.getAtomSetWithinGroup( atomSet );
    o.addRepresentation( "licorice", { sele: atomSet2.toSeleString() }
    );
    o.addRepresentation( "cartoon" );
    o.centerView();
} );</code></pre>


<h2>Hints</h2>

<p align=justify>Below find some hints to get a smooth running simulation.</p>
<br>
<p align=justify>If you're running a simulation with an expensive representation (e.g. surface), the update might not be in time (improvements in development) - therefore set off the worker: </p>
<pre><code>comp.addRepresentation( "surface", { sele: "protein", useWorker: false } );</code></pre>
<br>
<p align=justify>If you run into problems or have some specific questions, check out the <a target="_blank" href="https://github.com/arose/mdsrv/issues">Issue Tracker</a> - MDsrv&NGL are in active development and improvement!</p>


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
