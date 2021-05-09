function deleteg(pkid){
    $.post('deleteg.php',{'pkid': pkid},function(){
        alert('delete success')
        location.reload()
    })
    .error(function(){
        alert('error')
    })
}
function deletew(pkid){
    $.post('deletew.php',{'pkid': pkid},function(){
        alert('delete success')
        location.reload()
    })
    .error(function(){
        alert('error')
    })
    location.reload()
}