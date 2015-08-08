<?php
$h = new ENChtml();
$css = new ENCcss();
$joomla = new ENCjoomla();
$string = new ENCstring();
$url = new ENCurl();
$sch = new ENCschema();

$joomla->joomlaCategoryContent('id', $this->catIntroArray->catid);
$joomla->joomlaMenuContent('alias', $joomla->catAlias);
$url->disect();
	
$text = $string->breakExplode($this->catIntroArray->text);
$img = json_decode($this->catIntroArray->images);
$metadata = json_decode($this->catIntroArray->metadata);
$metakey = $string->explode($this->catIntroArray->metakey, ',');

$social = array(
	'{"class":"fb-share-button", "data-href":"'.$url->currentURL.'", "data-layout":"button_count"}',
	'{"class":"g-plus", "data-href":"'.$url->currentURL.'", "data-action":"share", "data-annotation":"bubble"}',
	'{"class":"twitter-share-button", "data-url":"'.$url->currentURL.'"}'
);

$h->b('article', 0, 1, $sch::blogPosting, $css::classContent);
	$h->b('figure', 0,1, $sch::imageObject);
		$h->b('img', 0, 1, $sch::contentUrl, '{"src":"'.$img->image_intro.'", "alt":"'.$img->image_intro_alt.'"}');
	$h->b('figure', 1,1);
	$h->b('section', 0, 1, '', '{"class":"inner"}');
		$h->b('div', 0, 1, '', $css::classLeft);
			$h->b('time', 0, 1, $sch::datePublished);
				$h->b('span', 0, 1);
					$h->e(1, $string->formatDate('d', $this->catIntroArray->created));
				$h->b('span', 1, 1);
				$h->b('span', 0, 1);
					$h->e(1, $string->formatDate('m.Y', $this->catIntroArray->created));
				$h->b('span', 1, 1);
			$h->b('time', 1, 1);
		$h->b('div', 1, 1);
		$h->b('div', 0, 1, '', $css::classRight);
			$h->b('h2', 0, 1, $sch::headline);
				$h->b('a', 0, 1, '', '{"href":"'.$joomla->linkArticle($this->catIntroArray->id, $joomla->menuId).'"}');
					$h->e(1, $this->catIntroArray->title);
				$h->b('a', 1, 1);
			$h->b('h2', 1, 1);
			$h->b('span', 0, 1, $sch::personAuthor);
				$h->b('a', 0, 1, $sch::url, '{"href":"'.$metadata->xreference.'"}');
					$h->b('span', 0, 1);
						$h->e(1, 'by ');
					$h->b('span', 1, 1);
					$h->b('span', 0, 1, $sch::name);
							$h->e(1, $metadata->author);
					$h->b('span', 1, 1);
				$h->b('a', 1, 1);
			$h->b('span', 1, 1);
			$h->b('ul', 0, 1, '', '{"class":"socialshares"}');
				foreach($social as $socialKey => $socialValue){
					$h->b('li', 0, 1);
						$h->b('a', 0, 1, '', $socialValue);
						$h->b('a', 1, 1);
					$h->b('li', 1, 1);	
				}
			$h->b('ul', 1, 1);
			$h->b('a', 0, 1, '', '{"href":"'.$joomla->linkArticle($this->catIntroArray->id, $joomla->menuId).'"}');
				$h->b('button', 0, 1);
					$h->e(1, 'View');
				$h->b('button', 1, 1);	
			$h->b('a', 1, 1);
		$h->b('div', 1, 1);
	$h->b('section', 1, 1);
$h->b('article', 1, 1);
?>