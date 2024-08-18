<?php
class bbcode_zinfinal {

	private $restrict = false;
	private $smile = true;
	private $smiles = array();
	private $restrict_static_bbcode = array('[b]', '[/b]','[i]', '[/i]','[u]', '[/u]');
	private $restrict_static_html = array('<b>', '</b>','<em>', '</em>','<u>', '</u>');
	private $advanced_static_bbcode = array('[align=left]', '[/align]','[align=center]', '[/align]','[align=right]', '[/align]');
	private $advanced_static_html = array('<div style="text-align: left;">', '</div>','<div style="text-align: center;">', '</div>','<div style="text-align: right;">', '</div>');
	private $restrict_static_smileys = array(
									':)' => '-288px; clip: rect(286px, 16px, 302px, 0px',
									';)' => '-310px; clip: rect(308px, 16px, 324px, 0px',
									':roll:' => '-332px; clip: rect(330px, 16px, 346px, 0px',
									':P' => '-354px; clip: rect(352px, 16px, 368px, 0px',
									':D' => '-376px; clip: rect(374px, 16px, 390px, 0px',
									':(' => '-398px; clip: rect(396px, 16px, 412px, 0px',
									'X(' => '-420px; clip: rect(418px, 16px, 434px, 0px',
									':cry:' => '-442px; clip: rect(440px, 16px, 456px, 0px',
									':twisted:' => '-464px; clip: rect(462px, 16px, 478px, 0px',
									':|' => '-486px; clip: rect(484px, 16px, 500px, 0px',
									':?' => '-508px; clip: rect(506px, 16px, 522px, 0px',
									':cool:' => '-530px; clip: rect(528px, 16px, 544px, 0px',
									':oops:' => '-552px; clip: rect(550px, 16px, 566px, 0px',
									'^^' => '-574px; clip: rect(572px, 16px, 588px, 0px',
									'8|' => '-596px; clip: rect(594px, 16px, 610px, 0px',
									':F' => '-618px; clip: rect(616px, 16px, 632px, 0px');

	function procesarbbcode($text){
		global $images;
		$text = htmlspecialchars($text, ENT_QUOTES);

		for ($i = 0; $i < count($this->restrict_static_bbcode); $i += 2){
			$pattern = '#'.preg_quote($this->restrict_static_bbcode[$i], '#').'(.+)'.preg_quote($this->restrict_static_bbcode[$i+1], '#').'#Usi';
			$replace = $this->restrict_static_html[$i].'$1'.$this->restrict_static_html[$i+1];
			$text = preg_replace($pattern, $replace, $text);
			
		}

		if ( !$this->restrict ){
		
			for ($i = 0; $i < count($this->advanced_static_bbcode); $i += 2){
			
				$pattern = '#'.preg_quote($this->advanced_static_bbcode[$i], '#').'(.+)'.preg_quote($this->advanced_static_bbcode[$i+1], '#').'#Usi';
				$replace = $this->advanced_static_html[$i].'$1'.$this->advanced_static_html[$i+1];
				$text = preg_replace($pattern, $replace, $text);
			
			}
			
			$pattern = array('#\[color=([a-zA-Z]*|\#?[0-9a-fA-F]{6})](.+)\[/color\]#Usi',
							 '#\[size=([0-9][0-9]?)](.+)\[/size\]#Usi',
							 '#\[font=(.+)](.+?)\[/font\]#Usi',
							 '#\[swf=http://www.youtube.com/v/(.*?)\]#si',
							 '#\[swf=http://video.google.com/googleplayer.swf?docId=(.*?)]#si',
							 '#\[swf=(.+)]#si',
							 '#\[img=(.+)]#si',
							 '#\[url](.+)\[/url]#Usi',
							 '#\[quote](\r\n)?(.+?)\[/quote]#si',
							 '#\[quote=(.*?)](\r\n)?(.+?)\[/quote]#si',
							 );

			$replace = array('<span style="color: $1">$2</span>',
							 '<span style="font-size: $1pt">$2</span>',
							 '<span style="font-family: $1;">$2</span>',
							 '<br><center><embed src="http://www.youtube.com/v/$1" quality="high" type="application/x-shockwave-flash" allownetworking="internal" allowscriptaccess="never" wmode="transparent" width="640px" height="385px"></center><br>',
							 '<br><center><embed src="http://video.google.com/googleplayer.swf?docId=$1" quality="high" type="application/x-shockwave-flash" allownetworking="internal" allowscriptaccess="never" wmode="transparent" width="425" height="350"></center><br>',
							 '<br><center><embed src="$1" quality="high" type="application/x-shockwave-flash" allownetworking="internal" allowscriptaccess="never" wmode="transparent" width="425" height="350"></center><br>',
							 '<img class="imagen" src="$1" border="0">',
							 '<a href="$1" target="_blank" rel="nofollow">$1</a>',
							 "<blockquote><div class=\"cita\"><strong></strong> dijo:</div><div class=\"citacuerpo\"><p>$2</p></div></blockquote>",
							 "<blockquote><div class=\"cita\"><strong>$1</strong> dijo:</div><div class=\"citacuerpo\"><p>$3</p></div></blockquote>",
							 );

			for ($i = 0; $i < count($pattern); $i++){
			
				while ( preg_match( $pattern[$i], $text ) > 0 )	
					$text = preg_replace($pattern, $replace, $text);
					
			}	
		
		}

		if ( $this->smile ){
			foreach($this->restrict_static_smileys as $name => $style)
				$text = str_ireplace($name, '<span style="position: relative;"><img src="'.$images.'/images/big2v5.gif" style="position: absolute; top: '.$style.');" vspace="2" hspace="3"><img src="'.$images.'/images/space.gif" style="vertical-align: middle; width: 15px; height: 15px;" vspace="2" hspace="3"></span>', $text);
		}

		$text = nl2br($text);
		
		return $text;
	
	}
	
}
?>