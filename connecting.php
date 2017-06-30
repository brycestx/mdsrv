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

<br>
<p align=justify>Big high performance computing (HPC) center might not want to deploy MDsrv on their cluster. Still, the MDsrv has some advantages over other simulation viewer, as it can handle unprocessed trajectories (periodic boundary, centering, superpositioning, reduction). By mounting this remote file system, the trajectories can be accessed. This guide will explain how to do this efficiently. You need to have installed the MDsrv on your local machine. Please keep your and your HPC center security guidelines in mind!</p>

<h2>Linux/Mac OS: sshfs - FUSE</h2>

<p align=justify>This tutorial is tested for Linux and Mac OS systems. We use sshfs, a FUSE module to mount the remote file system. If it is not already installed, do so:</p>

<pre><code>sudo apt-get install sshfs</code></pre>

<p align=justify>Create a local directory in which to mount the remote file system:</p>

<pre><code>mkdir /dir/to/mounted/system</code></pre>

<p align=justify>Now connect to the HPC center and view the current simulation with the MDsrv:</p>

<pre><code>sshfs username@cluster:/work/username/ /dir/to/mounted/system
cd /dir/to/mounted/system/projects/sims/
mdsrv gs_1.part0010.gro gs_1.part0001.xtc</code></pre>

<p align=justify>You can easily unmount it if you do not need it anymore:</p>

<pre><code>fusermount -u /dir/to/mounted/system</code></pre>

<p align=justify>Note that this provides only a temporary mount point. If the virtual server or local machine is powered off or restarted, you will need to use the same process to mount it again. You can overcome this by mounting it permanently. Have in mind that you might want to use some of the options to speed up the connection.</p>
<h2>Permanently mounting</h2>
<p align=justify>In order to set up a permanent mount point, you need to edit the <em>/etc/fstab</em> file on the local machine to automatically mount the file system each time the system is booted. Therefore add the following entry to your <em>/etc/fstab</em> at the bottom of the file and reboot afterwards:</p> 

<pre><code>sshfs#root@xxx.xxx.xxx.xxx:/ /dir/to/mounted/system</code></pre>

<p align=justify>Permanently mounting your HPC file system locally is a <strong>potential security risk</strong>. If your local machine is compromised it allows for a direct route to your HPC file system. Therefore it is not recommended to setup permanent mounts on production servers.</p> 

<h2>Speed it up!</h2>

<p align=justify>To speed up the connection, you need to change the syncronization by using one of those options:</p> 
<pre><code>sshfs username@cluster:/work/username/ /dir/to/mounted/system -o Ciphers=arcfour

sshfs username@cluster:/work/username/ /dir/to/mounted/system -oauto_cache,reconnect

further sshfs_opts="-o auto_cache -o cache_timeout=115200 -o attr_timeout=115200
                    -o entry_timeout=1200 -o max_readahead=90000 -o large_read 
                    -o big_writes -o no_remote_lock"</code></pre>

<br>


<h2>Windows: sshfs - FUSE</h2>

<p align=justify>sshfs also offers the possiblity for Windows users to mount remote file systems. We have not tested this but refer to this <a target="_blank" href="https://www.digitalocean.com/community/tutorials/how-to-use-sshfs-to-mount-remote-file-systems-over-ssh">tutorial</a>. </p> 

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