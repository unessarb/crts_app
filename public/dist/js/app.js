$(document).ready(() => {
  if ($(".custom-file-input").length > 0) {
    $(".custom-file-input").on("change", function (e) {
      var inputFile = e.currentTarget;
      $(inputFile)
        .parent()
        .find(".custom-file-label")
        .html(inputFile.files[0].name);
    });
  }

  if ($(".add_societe").length > 0) {
    function onClickAddSociete(event) {
      event.preventDefault();
      var data = $(this)
        .parent()
        .serializeArray()
        .reduce(function (obj, item) {
          var mySubString = item.name.substring(
            item.name.indexOf("[") + 1,
            item.name.lastIndexOf("]")
          );
          obj[mySubString] = item.value;
          return obj;
        }, {});
      console.log(data);
      $.ajax({
        type: "POST",
        url: $(this).parent().attr("action"),
        data: data,
        success: function (result) {
          console.log(result);
        },
        error: function (err) {
          console.log("error", err);
        },
      });
    }

    document.querySelectorAll(".add_societe").forEach(function (btn) {
      btn.addEventListener("click", onClickAddSociete);
    });
  }
});
