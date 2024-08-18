/* empty (php.js) 911.1619 */
function empty(a){var b;if(a===""||a===0||a==="0"||a===null||a===false||typeof a==="undefined")return true;if(typeof a=="object"){for(b in a)return false;return true}return false};

/* Search */
var search = {
	autor_intro: function(e, href, query, value, true_empty){
	  t = document.all ? e.keyCode : e.which;
	  if(t==13){
			this.autor_submit(href, query, value, true_empty);
		}
	},
	autor_submit: function(href, query, value, true_empty){
		if(empty(value) && !true_empty)
			return false;
		//Borro si habia algun filtro por user: anterior
		query = $.trim(query.replace(/(?:user|usuario):(?: )?([a-zA-Z0-9_]{5,35})/g, ''));
		if(empty(value))
			window.location.href = href + '&q=' + encodeURIComponent(query);
		else
			window.location.href = href + '&q=' + encodeURIComponent(query) + '&autor=' + encodeURIComponent(value);
	},

	categoria: function(href, query, value){
		//Borro si habia algun filtro por categoria: anterior
		query = $.trim(query.replace(/(?:cat|categoria):(?: )?([a-zA-Z0-9_]{3,21})/g, ''));
		if(value==-1)
			window.location.href = href + '&q=' + encodeURIComponent(query);
		else
			window.location.href = href + '&q=' + encodeURIComponent(query) + '&cat=' + encodeURIComponent(value);
	},

	pais: function(href, query, value){
		//Borro si habia algun filtro por categoria: anterior
		query = $.trim(query.replace(/(?:pais):(?: )?([a-zA-Z]{2,2})/g, ''));
		if(value==-1)
			window.location.href = href + '&q=' + encodeURIComponent(query);
		else
			window.location.href = href + '&q=' + encodeURIComponent(query) + '&pais=' + encodeURIComponent(value);
	},

	home_change_actual: 'posts',
	home_change: function(select, a){
		if(this.home_change_actual==select)
			return false;
		$('.search-options li').removeClass('active');
		$(a).parent().addClass('active');
		$('form[name="search-box"] input[name="q"]').focus();

		//Oculto todos los divs de filtros
		$('.filterSearch > div').hide();

		switch(select){
			case 'internet':
				$('form[name="search-box"]').attr('action', '/web');
				$('.filter-adv').hide();
				break;
			case 'posts':
				$('form[name="search-box"]').attr('action', '/posts');
				$('#filterPosts').show();
				$('.filter-adv').show();
				break;
			case 'comunidades':
				$('form[name="search-box"]').attr('action', '/comunidades');
				$('#filterComunidades').show();
				$('.filter-adv').show();
				break;
			case 'usuarios':
				$('form[name="search-box"]').attr('action', '/usuarios');
				$('.filter-adv').show();
				break;
		}
		this.home_change_actual = select;
	},
	
	onsubmit: function(){
		switch(this.home_change_actual){
			case 'internet':
				break;
			case 'posts':
				//Usando el filtro por categoria
				if($('#filterPosts .filterCategoria').val()!=-1)
					$('form[name="search-box"]').append('<input type="hidden" value="' + $('#filterPosts .filterCategoria').val() + '" name="cat" />');
				//Usando el filtro por autor
				if(!empty($('#filterPosts .filterAutor').val()))
					$('form[name="search-box"]').append('<input type="hidden" value="' + $('#filterPosts .filterAutor').val() + '" name="autor" />');
				break;
			case 'comunidades':
				//Tipo de buscador
				if($('#filterComunidades input[name=tipo_buscador]:checked').val()!='temas')
					$('form[name="search-box"]').append('<input type="hidden" value="comunidades" name="type" />');
				//Usando el filtro por categoria
				if($('#filterComunidades .filterCategoria').val()!=-1)
					$('form[name="search-box"]').append('<input type="hidden" value="' + $('#filterComunidades .filterCategoria').val() + '" name="cat" />');
				break;
			case 'usuarios':
				break;
		}
	},
	
	filterSearch_show: function(){
		var es_visible = $('.filterSearch').is(':visible');
		if(es_visible){
			$('.filter-adv').addClass('open');
			$('.filterSearch').hide();
		}else{
			$('.filter-adv').removeClass('open');
			$('.filterSearch').show();
		}
		var dominio = document.domain.split('.');
		dominio = dominio.slice(dominio.length - 2).join('.');
		document.cookie='search_filterSearch=' + (+!es_visible) + ';expires=Thu, 26 Jul 2012 16:12:48 GMT;path=/;domain=.'+dominio;
	},

	q_focus: function(){
		$('form[name="search-box"] input[name="q"]').focus();
	},
	intro_submit: function(e){
		tecla=(document.all)?e.keyCode:e.which;
		if(tecla==13)
			$('form[name="search-box"]').submit();
	},

	suggest: function(q_url, q_original, q, href){
		$.getJSON("http://search.yahooapis.com/WebSearchService/V1/spellingSuggestion?appid=Gs7HyLfV34FLispE.NBG7sZ_Z0XctH0zHDLRhbKFOizSoEQzPD4lXL2nbkosIzaP.T7HoQ--&output=json&callback=?&query=" + q_url,
			function(data){
				if(!empty(data.ResultSet.Result)){
					var suggest = data.ResultSet.Result;
					$('.suggest a').attr('href', href + encodeURIComponent(q_original.replace(q, suggest))).html(suggest);
					$('.suggest').fadeIn('slow');
				}
			});
	}
}

$(document).ready(function(){
	if(global_location=='posts' || global_location=='comunidades'){
		var ads_effect = {
			hideAll: function(){
				$('#results ol').hide();
				$('.paginadorBuscador').hide();
				$('.footer').hide();
			},
			showAll: function(){
				$('#results ol').show();
				$('.paginadorBuscador').show();
				$('.footer').show();
			},

			height: $('#avisosTop').css('height'),
			intentos: 1,
			time: setInterval(function(){
				ads_effect.check(ads_effect.intentos++);
			}, 100),

			check: function(intentos){
				if(intentos >= 15 || ads_effect.height != $('#avisosTop').css('height')){
					this.showAll();
					clearInterval(ads_effect.time);
				}
			}
		}
	}
    $('input[name=q]').keyup(function(e){
        if (search.home_change_actual == 'internet') {
            if (e.keyCode != 13 && e.keyCode != 38 && e.keyCode != 40) {
                var val = $.trim($(this).val());
                if (val.length >= 1) {
                    $.getScript('http://suggestqueries.google.com/complete/search?hl=es&q='+encodeURIComponent(val)+'&cp='+val.length);
                }
                else $('#suggest').hide();
            }
        }
    });
    $('input[name=q]').bind($.browser.msie ? 'keydown' : 'keypress', function(e){
        if (search.home_change_actual == 'internet') {
            if (e.keyCode == 13) {
                if ($('#suggest > ul > li.hover').length && $('#suggest').css('display') != 'none') {
                    e.preventDefault();
                    $('#suggest > ul > li.hover').click();
                }
            }
            else if (e.keyCode == 38) {
                if ($('#suggest > ul > li.hover').prev().length) {
                    var sel = $('#suggest > ul > li.hover').prev();
                    suggest_hover_clear();
                    suggest_hover(sel);
                }
                else {
                    suggest_hover_clear();
                    suggest_hover($('#suggest > ul > li:last'));
                }
            }
            else if (e.keyCode == 40) {
                if ($('#suggest > ul > li.hover').next().length) {
                    var sel = $('#suggest > ul > li.hover').next();
                    suggest_hover_clear();
                    suggest_hover(sel);
                }
                else {
                    suggest_hover_clear();
                    suggest_hover($('#suggest > ul > li:first'));
                }
            }
        }
    });
    $('#suggest > ul > li').live('click', function(){ suggest_set(this); $('form[name=search-box]').submit(); }).live('mouseleave', function(){ $(this).removeClass('hover'); }).live('mouseenter', function(){ suggest_hover_clear(); suggest_hover(this, true); });
    $('*').live('click', function(){ $('#suggest').hide(); });
});

function suggest_hover(el, nochange) {
    if (typeof nochange == 'undefined') var nochange = false;
    $(el).addClass('hover');
    if (!nochange) suggest_set(el);
}
function suggest_hover_clear() { $('#suggest > ul > li.hover').removeClass('hover'); }
function suggest_set(el) { $('input[name=q]').val($(el).html().replace(/<(?:\/)?span>/ig, '')); }

var google = {
	ac: {
	    h: function (data) {
	        var c = data[1].length, cls;
	        if (c) {
    	        $('#suggest').html('<ul></ul>').show();
    	        $('#suggest > ul').append('<li class="hidden hover">'+$.trim($('input[name=q]').val())+'</li>');
                for (var i = 0; i < c; ++i) {
                    $('#suggest > ul').append('<li>'+data[1][i][0]+'</li>');
                }
                $('#suggest > ul > li').each(function(){ $(this).html($(this).html().replace(new RegExp('('+$('input[name=q]').val()+')'), '<span>$1</span>')); });
            }
        }
    }
}

var lang = Array();
lang['error procesar'] = 'Ocurrio un error intenta nuevamente mas tarde';
function open_login_box() {
    $('li.identificate').addClass('active');
    $('li.identificate a').attr('href', 'javascript:close_login_box()');
    $('#login_box').show();
    $('#nickname').focus();
}
function close_login_box() {
    $('li.identificate').removeClass('active');
    $('li.identificate a').attr('href', 'javascript:open_login_box()');
    $('#login_box').hide();
}
function login_ajax(){
	if (!$('#nickname').val()) {
	    $('#nickname').focus();
		return;
	}
	if (!$('#password').val()) {
		$('#password').focus();
		return;
	}
	$('#login_error').hide();
	$('#login_cargando').show();
	$.ajax({
		type: 'post', url: '/login.php', cache: false, data: 'nick='+encodeURIComponent($('#nickname').val())+'&pass='+encodeURIComponent($('#password').val())+'&ajax=1',
		success: function (r) {
			if ($('#login_box').css('display') == 'block') {
				$('#login_cargando').hide();
				if (r.charAt(0) == '0') {
					$('#login_error').html(r.substring(3));
					$('#login_error').show();
					$('#nickname').focus();
					return;
				}
				if (r.charAt(0) == '2'){
					$('.login_cuerpo').css('text-align','center');
					$('.login_cuerpo').css('line-height','150%');
					$('.login_cuerpo').html(r.substring(3));
					return;
				}
			}
			if (r.charAt(0) == '1'){
				close_login_box();
				if (r.substring(3) == 'Home') location.href='/';
				else location.reload();
			}
		},
		error: function(){
			$('#login_error').html(lang['error procesar']);
			$('#login_error').show();
		}
	});
}
