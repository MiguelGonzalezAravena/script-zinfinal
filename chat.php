<?php
include("header.php");
cabecera_normal();

echo '<div class="container940">
			<div class="box_title">
				<div class="box_txt chat">Chat Taringa!</div>

				<div class="box_rrs">
					<div class="box_rss"></div> 
				</div>
			</div>
			<div class="box_cuerpo">	
				
				
				<!-- JWIRC applet begin-->
				<applet NAME="JWIRC" CODEBASE="/chat" ARCHIVE="/chat/jwirc_1_7_6.jar" code="IRC.class" width="100%" height="400">
					<param name="CABBASE" value="/chat/jwirc_1_7_6.cab">

					<param name="ConfigFile" value="config_taringa.txt">

					<param name="Nick"  value="Ciudadano_Taringa">
					<param name="Channels" value="#Taringa">
					<param name="ChList" value="#Taringa">
                                        <param name="UserInfo" value="Poringa! applet user">
					
					<param name="ServersString" value="
					:DalNet
					Chan Nick 6667! 
					irc.dal.net">
				</applet>
				
				<table border="0">
					<tr>
					<td>

						<a href="javascript:document.JWIRC.appendFromJS(\':)\')"><IMG SRC="/chat/smile.gif" border=0></a>
					</td><td>
						<a href="javascript:document.JWIRC.appendFromJS(\':))\')"><IMG SRC="/chat/bigsmile.gif" border=0></a>
					</td><td>
						<a href="javascript:document.JWIRC.appendFromJS(\':P\')"><IMG SRC="/chat/tongue.gif" border=0></a>
					</td><td>
						<a href="javascript:document.JWIRC.appendFromJS(\'.)\')"><IMG SRC="/chat/wink.gif" border=0></a>
					</td><td>
						<a href="javascript:document.JWIRC.appendFromJS(\'LOL\')"><IMG SRC="/chat/lol.gif" border=0></a>

					</td><td>
						<a href="javascript:document.JWIRC.appendFromJS(\':-|\')"><IMG SRC="/chat/rolleyes.gif" border=0></a>
					</td><td>
						<a href="javascript:document.JWIRC.appendFromJS(\':(\')"><IMG SRC="/chat/sad.gif" border=0></a>
					</td><td>
						<a href="javascript:document.JWIRC.appendFromJS(\';(\')"><IMG SRC="/chat/cry.gif" border=0></a>
					</td><td>
						<a href="javascript:document.JWIRC.appendFromJS(\':O\')"><IMG SRC="/chat/furcht.gif" border=0>
					</td><td>

						<a href="javascript:document.JWIRC.appendFromJS(\':-||\')"><IMG SRC="/chat/gr.gif" border=0>
					</td>
					</tr>
				</table>
				
			</div>
		</div>';

pie();
?>