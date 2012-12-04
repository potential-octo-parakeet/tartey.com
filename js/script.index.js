/* 
 * TARTEY.COM
 * Developer: Mar Cejas
 * Created: 11/26/2011
 * Last Modified: None
 */
 
$(document).ready(function(){
	var offset = 0;
	var rowset = 0;	
	var p_btn = $('#post_button');
	var p_msg = $('textarea.textarea');
	var p_def = 'Write something...';
	var f_msg = $('form[name=post_status]');
	var p_ajx = $('#post-throbber');
	f_msg.submit(function(){		
		p_ajx.ajaxStart(function(){
			p_btn.hide();$(this).fadeIn();}).ajaxStop(function(){
				$(this).fadeOut(function(){p_btn.show()}).unbind();
		});
		$.post('ajax/post_status.php',$(this).serialize(),function(r){
			if(r=='ok'){
				$('#thread-msgs-wrapper').load('ajax/threads.php');
				p_msg.val('').focus()
			}
		});
		return false;
	});
	p_msg.focus(function(e){
		if(this.value==p_def){
			$(this).val('');
		}
	}).blur(function(){
		if(this.value==''){
			$(this).val(p_def);
		}
	});
	$('#thread-msgs-wrapper').load('ajax/threads.php');

	setInterval(function(){
		$.get('ajax/qdb.php',{rowset:'true'},function(r){
			if(r!=rowset){
				$('#thread-msgs-wrapper').fadeIn().load('ajax/threads.php');
			}
			rowset=r;
		})
	},5000);
	$('#people_umwtk').load('ajax/people_umwtk.php');
	setInterval(function(){$('#people_umwtk').load('ajax/people_umwtk.php');},60000);
});