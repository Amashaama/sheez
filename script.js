//youtube//

// youtube//

function changeView() {
  var signUpBox = document.getElementById("signupbox");
  var signInBox = document.getElementById("signinbox");

  signUpBox.classList.toggle("d-none");
  signInBox.classList.toggle("d-none");
}

function signUp() {
  var fn = document.getElementById("fname");
  var ln = document.getElementById("lname");
  var e = document.getElementById("email");
  var pw = document.getElementById("password");
  var m = document.getElementById("mobile");
  var g = document.getElementById("gender");

  var f = new FormData();
  f.append("fname", fn.value);
  f.append("lname", ln.value);
  f.append("email", e.value);
  f.append("password", pw.value);
  f.append("mobile", m.value);
  f.append("gender", g.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      if (t == "success") {
        document.getElementById("msg").innerHTML = t;
        document.getElementById("msg").className = "alert alert-success";
        document.getElementById("msgdiv").className = "d-block";
      } else {
        document.getElementById("msg").innerHTML = t;
        document.getElementById("msgdiv").className = "d-block";
      }
    }
  };

  r.open("POST", "signUpProcess.php", true);
  r.send(f);
}

var bm;

function forgotPassword() {
  var email = document.getElementById("email2").value;

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if ((r.readyState == 4) & (r.status == 200)) {
      var t = r.responseText;
      if (t == "success") {
        alert("a verification code has been sent to your email address");
        var m = document.getElementById("forgotPasswordModal");
        bm = new bootstrap.Modal(m);
        bm.show();
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "forgotPasswordProcess.php?e=" + email, true);
  r.send();
}

function signin() {
  var email = document.getElementById("email2");
  var password = document.getElementById("password2");
  var rememberme = document.getElementById("rememberme");

  var f = new FormData();

  f.append("e", email.value);
  f.append("p", password.value);
  f.append("r", rememberme.checked);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;

      if (t == "success") {
        window.location = "home5.php";
      } else {
        alert(t);
      }
    }
  };
  r.open("POST", "signinProcess.php", true);
  r.send(f);
}

function showPassword() {
  var np = document.getElementById("np");
  var npb = document.getElementById("npb");

  if (np.type == "password") {
    np.type = "text";
    npb.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
  } else {
    np.type = "password";
    npb.innerHTML = '<i class="bi bi-eye-fill"></i>';
  }
}

function showPassword2() {
  var rnp = document.getElementById("rnp");
  var rnbp = document.getElementById("rnbp");

  if (rnp.type == "password") {
    rnp.type = "text";
    rnbp.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
  } else {
    rnp.type = "password";
    rnbp.innerHTML = '<i class="bi bi-eye-fill"></i>';
  }
}

function resetPassword() {
  var email = document.getElementById("email2");
  var np = document.getElementById("np");
  var rnp = document.getElementById("rnp");
  var vc = document.getElementById("vc");

  var f = new FormData();
  f.append("e", email.value);
  f.append("np", np.value);
  f.append("rnp", rnp.value);
  f.append("vc", vc.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      if (t == "success") {
        bm.hide();
        alert("Your password has been updated.");
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "resetPasswordProcess.php", true);
  r.send(f);
}

/* single product */
function changeMainImg(id) {
  var new_img = document.getElementById("product_img" + id).src;
  var main_img = document.getElementById("mainImg");

  main_img.style.backgroundImage = "url(" + new_img + ")";
}

function qty_inc(qty) {
  var input = document.getElementById("qty_input");

  if (input.value < qty) {
    var new_value = parseInt(input.value) + 1;
    input.value = new_value;
  } else {
    alert("You have reached to the Maximum value");
    input.value = qty;
  }
}

function qty_dec(qty) {
  var input = document.getElementById("qty_input");

  if (input.value > 1) {
    var new_value = parseInt(input.value) - 1;
    input.value = new_value;
  } else {
    alert("You have reached to the Minimum value");
    input.value = 1;
  }
}

function check_value(qty) {
  var input = document.getElementById("qty_input");

  if (input.value < 1) {
    alert("You must add one or more");
    //input.value =1;
  } else if (input.value > qty) {
    alert("Insufficient quantity");
    input.value = qty;
  }
}
/* single product */

/* admin page */

var av;
function adminVerification() {
  var email = document.getElementById("e");

  var f = new FormData();
  f.append("e", email.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        var adminVerificationModal =
          document.getElementById("verificationModal");
        av = new bootstrap.Modal(adminVerificationModal);
        av.show();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "adminVerificationProcess.php", true);
  r.send(f);
}

function verify() {
  var verification = document.getElementById("vcode");

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        av.hide();
        window.location = "adminPanel.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "verificationProcess.php?v=" + verification.value, true);
  r.send();
}

/* my products */

function sort(x) {
  var search = document.getElementById("s");

  var category = "0";

  if (document.getElementById("cwc").checked) {
    category = "1";
  } else if (document.getElementById("cwa").checked) {
    category = "2";
  } else if (document.getElementById("cnw").checked) {
    category = "3";
  } else if (document.getElementById("cew").checked) {
    category = "4";
  }

  var time = "0";

  if (document.getElementById("n").checked) {
    time = "1";
  } else if (document.getElementById("o").checked) {
    time = "2";
  }

  var qty = "0";

  if (document.getElementById("h").checked) {
    qty = "1";
  } else if (document.getElementById("l").checked) {
    qty = "2";
  }

  var condition = "0";

  if (document.getElementById("b").checked) {
    condition = "1";
  } else if (document.getElementById("u").checked) {
    condition = "2";
  }

  var f = new FormData();

  f.append("s", search.value);
  f.append("t", time);
  f.append("q", qty);
  f.append("c", condition);
  f.append("cat", category);
  f.append("page", x);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;

      document.getElementById("sort").innerHTML = t;
    }
  };

  r.open("POST", "sortProcess.php", true);
  r.send(f);
}

function clearSort() {
  window.location.reload();
}

function changeStatus(id) {
  var product_id = id;

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = this.responseText;

      if (t == "activated" || t == "deactivated") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "changeStatusProcess.php?p=" + product_id, true);
  r.send();
}

function sendId(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;

      if (t == "success") {
        window.location = "updateProduct.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "sendIdProcess.php?id=" + id, true);
  r.send();
}

/* my products */

/* admin sign in */
function adminSignIn() {
  var email = document.getElementById("email2");

  var f = new FormData();
  f.append("e", email.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "adminPanel.php";
      } else {
        document.getElementById("msg").innerHTML = t;
        document.getElementById("msgDiv").className = "d-block";
      }
    }
  };

  r.open("POST", "adminSignInProcess.php", true);
  r.send(f);
}

/* admin sign in */

/*admin Panel */

function loadUser() {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var r = request.responseText;
      document.getElementById("tb").innerHTML = r;
      //document.getElementById("trp").innerHTML = r;
    }
  };

  request.open("POST", "loadUserProcess.php", true);
  request.send();
}

function changeStatusAdmin() {
  var email = document.getElementById("user_email");

  var f = new FormData();
  f.append("e", email.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        document.getElementById("msg").innerHTML = t;
        document.getElementById("msgDiv").className = "d-block";
        document.getElementById("msg").className = "alert alert-success";
      } else {
        document.getElementById("msg").innerHTML = t;
        document.getElementById("msgDiv").className = "d-block";
      }
    }
  };

  r.open("POST", "changeStatusAdminProcess.php", true);
  r.send(f);
}

function changeStatusProduct() {
  var pid = document.getElementById("pid");

  var f = new FormData();
  f.append("pid", pid.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "Product Deactivated") {
        document.getElementById("msg").innerHTML = t;
        document.getElementById("msgDiv").className = "d-block";
        document.getElementById("msg").className = "alert alert-danger";
      } else if ("Product Activate") {
        document.getElementById("msg").innerHTML = t;
        document.getElementById("msgDiv").className = "d-block";
      }
    }
  };

  r.open("POST", "changeProductStatus.php", true);
  r.send(f);
}

function tableSearchProduct() {
  var pid = document.getElementById("pid").value;

  var f = new FormData();
  f.append("pid", pid);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var r = request.responseText;

      document.getElementById("msgDiv").className = "d-block";
      document.getElementById("tbb").innerHTML = r;

      //document.getElementById("trp").innerHTML = r;
    }
  };

  request.open("POST", "tableSearchProductProcess.php", true);
  request.send(f);
}

function loadFg(id) {
  window.location = "feedbackGraph.php?id=" + id;
}

function loada() {
  window.location = "table.php";
}

function loadb() {
  window.location = "table2.php";
}

function loadcmS() {
  window.location = "customerSpends.php";
}
function loadReplyPageAgain() {
  window.location = "reply.php";
}

function printDiv() {
  var original = document.body.innerHTML;
  var printArea = document.getElementById("printArea").innerHTML;

  document.body.innerHTML = printArea;

  window.print();

  document.body.innerHTML = original;
}

function loadQNA(qid) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      document.getElementById("answer_form").innerHTML = t;
    }
  };

  r.open("GET", "loadQNAProcess.php?id=" + qid, true);
  r.send();
}

function submitAdminAnswer(id) {
  var answer = document.getElementById("aanswer").value;

  //var f = new FormData();
  // f.append("a", answer.value);
  // f.append("q", aqid);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == 1) {
        alert("answer successfully updated");
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open(
    "GET",
    "submitAdminAnswerProcess.php?id=" + id + "&ans=" + answer,
    true
  );
  r.send();
}

function addProduct() {
  var category = document.getElementById("category");

  var title = document.getElementById("title");
  var condition = 0;
  if (document.getElementById("b").checked) {
    var condition = 1;
  } else if (document.getElementById("u").checked) {
    var condition = 2;
  }

  var clr = document.getElementById("clr");
  var dwc = document.getElementById("dwc");
  var doc = document.getElementById("doc");
  var desc = document.getElementById("desc");
  var image = document.getElementById("imageuploader");

  var f = new FormData();

  f.append("ca", category.value);

  f.append("t", title.value);
  f.append("con", condition);
  f.append("clr", clr.value);
  f.append("dwc", dwc.value);
  f.append("doc", doc.value);
  f.append("desc", desc.value);

  var file_count = image.files.length;

  for (var x = 0; x < file_count; x++) {
    f.append("img" + x, image.files[x]);
  }
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      if (t == "success") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "addProductProcess.php", true);
  r.send(f);
}

function changeProductImageAp() {
  var images = document.getElementById("imageuploader");

  images.onchange = function () {
    var file_count = images.files.length;

    if (file_count <= 4) {
      for (var x = 0; x < file_count; x++) {
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);
        document.getElementById("i" + x).src = url;
      }
    } else {
      alert(file_count + " files uploaded. Maximum file count is 4 .");
    }
  };
}

function addToStock() {
  //alert("ok");

  var pid = document.getElementById("pid");
  var model = document.getElementById("model");
  var newm = document.getElementById("model_new");
  var brand = document.getElementById("brand");
  var newb = document.getElementById("brand_new");
  var price = document.getElementById("cost");
  var qty = document.getElementById("qty");
  var status = document.getElementById("status");

  var f = new FormData();

  f.append("t", pid.value);
  f.append("m", model.value);
  f.append("nm", newm.value);
  f.append("b", brand.value);
  f.append("nb", newb.value);
  f.append("p", price.value);
  f.append("q", qty.value);
  f.append("s", status.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if ((r.status = 200 && r.readyState == 4)) {
      var t = r.responseText;

      if (t == 1) {
        alert("Product added to stock successfully");
        window.location.reload();
      } else if (t == 2) {
        alert("Product added to stock successfully");
        window.location.reload();
      } else if (t == 3) {
        alert("Product added to stock successfully");
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "addToStockProcess.php", true);
  r.send(f);
}

function updateProduct() {
  var title = document.getElementById("t");
  var qty = document.getElementById("q");
  var dwc = document.getElementById("dwc");
  var doc = document.getElementById("doc");
  var description = document.getElementById("d");
  var image = document.getElementById("imageuploader");

  var f = new FormData();
  f.append("t", title.value);
  f.append("q", qty.value);
  f.append("dwc", dwc.value);
  f.append("doc", doc.value);
  f.append("d", description.value);

  var file_count = image.files.length;
  for (var x = 0; x < file_count; x++) {
    f.append("i" + x, image.files[x]);
  }

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;

      if (t == " success") {
        alert("success");
        window.location = "myProducts.php";
      } else if (t == "Invalid Image Count") {
        if (confirm(" you dont want to update Product Images?") == true) {
          window.location = "myProducts.php";
        } else {
          alert("Select images.");
        }
      } else {
        //alert(t = "successsuccesscuccess or successsuccess");
        window.location = "myProducts.php";
      }
    }
  };

  r.open("POST", "updateProductProcess.php", true);
  r.send(f);
}

function loadD() {}

/*end admin Panel */

/* watchlist */
function addToWatchlist(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;

      if (t == "Added") {
        alert("Product Added to the Watchlist.");
        /* window.location.reload(); */
      } else if (t == "Removed") {
        alert("Product Removed From Watchlist Successfully.");
        /*  window.location.reload(); */
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "addToWatchlistProcess.php?id=" + id, true);
  r.send();
}

function removeFromWatchlist(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      if (t == "Deleted") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "removeFromWatchlistProcess.php?id=" + id, true);
  r.send();
}

/* end watchlist */

/* start cart */

function addToCart(id) {
 
  var qty = document.getElementById("qty_input").value;

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;

      if (t == "Added") {
        alert("Product Added to the Cart.");
        /* window.location.reload(); */
      } else if (t == "Removed") {
        alert("Product Removed From Cart Successfully.");
        /* window.location.reload(); */
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "addToCartProcess.php?id=" + id + "&qty=" + qty, true);
  r.send();
}

function deleteFromCart(cart_id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;

      if (t == "Product has been removed") {
        alert(t);
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "removeCartProcess.php?id=" + cart_id, true);
  r.send();
}

function paynow(pid) {

  var qty = document.getElementById("qty_input").value;
 // var size = document.getElementById("size_id").value;

  var r = new XMLHttpRequest();
 

  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      var obj = JSON.parse(t);

      var umail = obj["umail"];
      var amount = obj["amount"];

      if (t == "address error") {
        alert("Please Update Your Profile.");
        window.location = "userProfile.php";
      } else {
        // Payment completed. It can be a successful failure.
        payhere.onCompleted = function onCompleted(orderId) {
          console.log("Payment completed. OrderID:" + orderId);

          window.location = "invoice.php?id=" + pid;
          // Note: validate the payment and show success or failure page to the customer
        };

        // Payment window closed
        payhere.onDismissed = function onDismissed() {
          // Note: Prompt user to pay again or show an error page
          console.log("Payment dismissed");
        };

        // Error occurred
        payhere.onError = function onError(error) {
          // Note: show an error page
          console.log("Error:" + error);
        };

        // Put the payment variables here
        var payment = {
          sandbox: true,
          merchant_id: "1224036", // Replace your Merchant ID
          return_url: "http://localhost/sheez/singleProductView.php?id=" + pid, // Important
          cancel_url: "http://localhost/sheez/singleProductView.php?id=" + pid, // Important
          notify_url: "http://sample.com/notify",
          order_id: obj["id"],
          items: obj["item"],
          amount: amount,
          currency: "LKR",
          hash: obj["hash"], // *Replace with generated hash retrieved from backend
          first_name: obj["fname"],
          last_name: obj["lname"],
          email: umail,
          phone: obj["mobile"],
          address: obj["address"],
          city: obj["city"],
          country: "Sri Lanka",
          delivery_address: obj["address"],
          delivery_city: obj["city"],
          delivery_country: "Sri Lanka",
          custom_1: "",
          custom_2: "",
        };

        // Show the payhere.js popup, when "PayHere Pay" is clicked
        // document.getElementById('payhere-payment').onclick = function (e) {
        payhere.startPayment(payment);
        // };
      }
    }
  };

  r.open("GET", "payNowProcess.php?id=" + pid + "&qty=" + qty + "&size=" + size, true);
  r.send();
}

/* invoice */

function printInvoice() {
  var restorepage = document.body.innerHTML;
  var page = document.getElementById("page").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = restorepage;
}

/*end invoice */

function submitComment(pid) {
  var comment = document.getElementById("getComment");

  var f = new FormData();
  f.append("feedback", comment.value);
  f.append("pid", pid);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == 1) {
        window.location.reload();
      }
    }
  };

  r.open("POST", "saveFeedbackProcess.php", true);
  r.send(f);
}

function submitQuestion(pid) {
  var q = document.getElementById("getQuestion");

  var f = new FormData();
  f.append("q", q.value);
  f.append("pid", pid);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      if (t == 1) {
        window.location.reload();
      } else {
        alert(t);
        window.location.reload();
      }
    }
  };

  r.open("POST", "submitQuestionProcess.php", true);
  r.send(f);
}

function loadrecent() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("tbd").innerHTML = t;
    }
  };

  r.open("POST", "loadRecentProcess.php", true);
  r.send();
}

var m;
function addFeedback(id) {
  // var feedbackModal = document.getElementById("feedbackModal");
  // m = new bootstrap.Modal(feedbackModal);
  // m.show();
}

function changeProductImage() {
  var images = document.getElementById("imageuploader");

  images.onchange = function () {
    var file_count = images.files.length;

    if (file_count <= 3) {
      for (var x = 0; x < file_count; x++) {
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);
        document.getElementById("i" + x).src = url;
      }
    } else {
      alert(file_count + " files uploaded. Maximum file count is 3 .");
    }
  };
}

function saveFeedback(inid) {
  var type;

  if (document.getElementById("type1").checked) {
    type = 1;
  } else if (document.getElementById("type2").checked) {
    type = 2;
  } else if (document.getElementById("type3").checked) {
    type = 3;
  }

  var feedback = document.getElementById("feed");
  var image = document.getElementById("imageuploader");

  var f = new FormData();

  f.append("inid", inid);
  f.append("t", type);
  f.append("feed", feedback.value);

  var file_count = image.files.length;

  for (var i = 0; i < file_count; i++) {
    f.append("img" + i, image.files[i]);
  }

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;

      if (t == "1") {
        alert("Feedback Saved Successfully");

        window.location = "r.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "saveFeedbackProcess.php", true);
  r.send(f);
}

// sp View feedback Pop up image

function openModal(imageSrc) {
  var modal = document.getElementById("myModal");
  var modalImg = document.getElementById("modalImage");
  modal.style.display = "block";
  modalImg.src = imageSrc;
}

function closeModal() {
  var modalclo = document.getElementById("myModal");
  modalclo.style.display = "none";
}

//end sp view pop up

//start header SEARCH //

function basicSearch(x) {
  var text = document.getElementById("kw").value;
  var select = document.getElementById("c").value;

  var f = new FormData();

  f.append("t", text);
  f.append("s", select);
  f.append("page", x);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;

      document.getElementById("basicSearchResult").innerHTML = t;
    }
  };

  r.open("POST", "basicSearchProcess.php", true);
  r.send(f);
}

//end header SEARCH //

function advancedSearch(x) {
  // advanced search ekn value ekk gnna bln inna hind 0 neme x kiyl dnw

  var txt = document.getElementById("type");
  var category = document.getElementById("cat");
  var brand = document.getElementById("brand");
  var model = document.getElementById("model");
  var condition = document.getElementById("condition");
  var color = document.getElementById("color");
  var from = document.getElementById("pf");
  var to = document.getElementById("pt");
  var sort = document.getElementById("ps");

  var f = new FormData();

  f.append("t", txt.value);
  f.append("cat", category.value);
  f.append("b", brand.value);
  f.append("mo", model.value);
  f.append("con", condition.value);
  f.append("col", color.value);
  f.append("pf", from.value);
  f.append("pt", to.value);
  f.append("s", sort.value);
  f.append("page", x);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      // alert(t);
      document.getElementById("view_area").innerHTML = t;
    }
  };

  r.open("POST", "advancedSearchProcess.php", true);
  r.send(f);
}

function updateProfile() {
  var profile_img = document.getElementById("profileImage");
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile_no = document.getElementById("mobile");
  var password = document.getElementById("pw");
  var email_address = document.getElementById("email");
  var address_line_1 = document.getElementById("line1");
  var address_line_2 = document.getElementById("line2");
  var province = document.getElementById("province");
  var district = document.getElementById("district");
  var city = document.getElementById("city");
  var postal_code = document.getElementById("pc");

  var f = new FormData();

  f.append("img", profile_img.files[0]);
  f.append("fn", fname.value);
  f.append("ln", lname.value);
  f.append("mn", mobile_no.value);
  f.append("pw", password.value);
  f.append("ea", email_address.value);
  f.append("al1", address_line_1.value);
  f.append("al2", address_line_2.value);
  f.append("p", province.value);
  f.append("d", district.value);
  f.append("c", city.value);
  f.append("pc", postal_code.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;

      if (t == "success") {
        signout();

        window.location = "index.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "userProfileUpdateProcess.php", true);
  r.send(f);
}

function showPassword3() {
  var password = document.getElementById("pw");
  var set = document.getElementById("pwb");

  if (password.type == "password") {
    password.type = "text";
    set.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
  } else {
    password.type = "password";
    bsa.innerHTML = '<i class="bi bi-eye-fill"></i>';
  }
}

function signout() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      if (t == "success") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "signoutProcess.php", true);
  r.send();
}

function cartSaveQty(id) {
  var qty = document.getElementById("qty_input").value;

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "success") {
        document.getElementById("qty_input").innerHTML = qty;
      }
    }
  };

  r.open("GET", "cartValueUpdateProcess.php?qty=" + qty + "&pid=" + id, true);
  r.send();
}

function loadSwiperadd() {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState) {
      var t = r.responseText;
      document.getElementById("home_add_view").innerHTML = t;
    }
  };

  r.open("GET", "loadSwiperProcess.php", true);
  r.send();
}

function ChangeProductImageApS() {
  var images = document.getElementById("imageupload");

  images.onchange = function () {
    var file_count = images.files.length;

    if (file_count <= 12) {
      for (var x = 0; x < file_count; x++) {
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);
        document.getElementById("i" + x).src = url;
      }
    } else {
      alert(file_count + " files uploaded. Maximum file count is 12 .");
    }
  };
}
function swiperReload() {
  window.location.reload();
}

function saveSwiperImg() {
  var image = document.getElementById("imageupload");

  var f = new FormData();

  var file_count = image.files.length;

  for (var x = 0; x < file_count; x++) {
    f.append("img" + x, image.files[x]);
  }

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "saveSwiperImgProcess.php", true);
  r.send(f);
}

function loadBrandImages() {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState) {
      var t = r.responseText;
      document.getElementById("home_add_view").innerHTML = t;
    }
  };

  r.open("GET", "loadBrandImagesProcess.php", true);
  r.send();
}

function ChangeProductImageApB() {
  var images = document.getElementById("imageuploadb");

  images.onchange = function () {
    var file_count = images.files.length;
    if (file_count <= 1) {
      for (var x = 0; x < file_count; x++) {
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);
        document.getElementById("i" + x).src = url;
      }
    } else {
      alert(file_count + " files uploaded. Maximum file count is 1. ");
    }
  };
}

function saveBrandImg() {
  var image = document.getElementById("imageuploadb");
  var brand_id = document.getElementById("brand_i");

  var f = new FormData();

  f.append("img", image.files[0]);
  f.append("bid", brand_id.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if(t=="successs"){
        window.location.reload();

      }else if(t="brand image updated"){
        alert(t);
        window.location.reload();
      }else{
        alert(t);
      }
    }
  };

  r.open("POST", "saveBrandProcess.php", true);
  r.send(f);
}
function saveNewBrand() {
  var brand = document.getElementById("brand_name").value;

  var f = new FormData();
  f.append("b", brand);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if(t=="success"){
        window.location.reload();
      }else if (t="This brand is in your brand list"){
        alert(t);
        window.location.reload();
      }else{
        alert(t);
      }
    }
  };

  r.open("POST", "saveNewBrandProcess.php", true);
  r.send(f);
}


