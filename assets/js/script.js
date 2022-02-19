$(document).ready(function () {
  $(".result").on("click", function () {
   
    var id = $(this).attr("data-linkid"); 
   var url = $(this).attr("href");
    

    if (!id) {
      alert("data-linkid not found");
    }

    increaseLinkClicks(id, url);

    return false;
  });
});

function increaseLinkClicks(linkid, url) {
   $.post("ajax/updateLinkCount.php", { linkid: linkid })
    .done(function (result) {
    console.log(result);
    if (result != "") {
      alert(result);
      return;
    }
    window.location.href = url;
  });
}
