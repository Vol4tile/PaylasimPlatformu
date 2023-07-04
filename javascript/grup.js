$("*").click(function (event) {
  if (!$(event.target).is("input[name=ara]")) {
    $("#sonuc").css("display", "none");
    $("#aralogo").show();
    $("#ara input").css("text-indent", "20px");
    $("#triangle").hide();
  }
});

$("input[name=ara]").click(function () {
  var button = $("input[name=ara]");
  $("#aralogo").hide();
  $("#ara input").css("text-indent", "0px");
  $("#sonuc").show();
  $("#triangle").show();
});

$("input[name=ara]").keyup(function () {
  var value = $(this).val();
  var konu = "value=" + value;

  $.ajax({
    type: "POST",
    url: "ajaxarama.php",
    data: konu,
    success: function (sonuc) {
      $("#sonuc").html(sonuc);
    },
  });
});

var resim = document.getElementById("resim");
var onizle = document.getElementById("onizle");
var onizlediv = document.getElementById("onizlediv");
resim.addEventListener("change", function () {
  onizlediv.style.display = "block";
  x = this.files[0];
  var reader = new FileReader();
  reader.readAsDataURL(x);
  reader.onload = function (evt) {
    onizle.src = evt.target.result;
  };
});

$("#grupOlustur").on("submit", function (event) {
  event.preventDefault();

  $.ajax({
    url: "grupolustur.php",
    type: "POST",
    dataType: "JSON",
    data: new FormData(this),
    processData: false,
    contentType: false,
    success: function (x) {
      console.log(x.responseText);
      alert("Grup oluşturuldu");
    },
    error: function (x) {
      console.log(x.responseText);
      alert("Grup oluşturuldu");
    },
  });
});

$("#yazi").on("click", function (event) {
  $("#innercontainer").css("display", "block");
  $("#grupisimleri").css("display", "none");
});
$("#gruplariListele").on("click", function (event) {
  document.getElementById("grupisimleri").innerHTML = "";
  $("#innercontainer").css("display", "none");
  $("#grupisimleri").css("display", "block");
  $.ajax({
    url: "gruplariListele.php",
    type: "POST",

    success: function (x) {
      document.getElementById("grupisimleri").innerHTML += x;
    },
    error: function (x) {},
  });
});

function fun(yazi, x) {
  x = x;
  var konu = "value=" + yazi;

  $.ajax({
    type: "POST",
    url: "grupUyeOl.php",
    data: konu,
    success: function (sonuc) {
      x.innerHTML = "Gruba katılma isteği gönderildi";
    },
  });
}

$("#benimGruplar").on("click", function (event) {
  $("#innercontainer").css("display", "none");
  $("#grupisimleri").css("display", "none");

  $.ajax({
    type: "POST",
    url: "gruplarimiGoster.php",
    dataType: "JSON",
    data: "sa",
    success: function (sonuc) {},
    error: function (data) {
      document.getElementById("grupisimleri").innerHTML = data.responseText;

      $("#grupisimleri").css("display", "block");
      $(".grup_sayfasi").on("click", function (event) {
        var degisken = this.id;
        event.preventDefault();
        $.ajax({
          type: "POST",
          url: "grupsayfasiajax.php",
          dataType: "JSON",
          data: { degisken: degisken },
          success: function (sonuc) {},
          error: function (sonuc) {
            document.getElementById("grupisimleri").innerHTML =
              sonuc.responseText;
            $("#grup_post").on("submit", function (event) {
              event.preventDefault();
              $.ajax({
                url: "gruppaylasimyap.php",
                type: $(this).attr("method"),
                dataType: "JSON",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (data) {
                  alert("Paylaşım başarıyla yapıldı.");
                },
                error: function (data) {
                  alert("Paylaşım başarıyla yapıldı.");
                },
              });
            });
          },
        });
      });
    },
  });
});

$(".isActive").on("click", function (e) {
  $(".isActive").css("background-color", "white");
  $(".isActive").css("color", "black");
  $(this).css("background-color", "black");
  $(this).css("color", "white");
});

$("#bildirim").click(function (e) {
  e.preventDefault();
  $("#bildirimsonuc").show();
  $("#bildirimucgen").show();

  var data = $("#userid").val();

  $.ajax({
    type: "POST",
    url: "bildirimajax.php",
    data: { data },
    success: function (sonuc) {
      $("#bildirimsonuc").html(sonuc);
    },
  });
});
function kabulet(x) {
  $.ajax({
    type: "POST",
    url: "bildirimdurumajax.php",
    data: { x },
    success: function (sonuc) {},
  });
}
function ret(x, y) {
  $.ajax({
    type: "POST",
    url: "bildirimdurumajax2.php",
    data: { x },
    success: function (sonuc) {},
  });
}

function kapat() {
  $("#bildirimsonuc").hide();
  $("#bildirimucgen").hide();
}
