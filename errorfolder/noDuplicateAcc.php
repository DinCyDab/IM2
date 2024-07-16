<style>
  .errorMsgHolder {
    position: fixed;
    width: 100%;
    height: 100vh;
    background-color: rgba(0, 0, 0, .4);
    top: 0px;
    z-index: 1;
  }

  .errorMSG {
    position: relative;
    width: 30%;
    height: auto;
    color: white;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    background-color: wheat;
    border-radius: 20px;
    padding: 20px;
  }

  .errorMSG h1 {
    color: red;
  }

  .errorMSG p {
    color: black;
    text-decoration: underline;
  }
</style>

<div class="errorMsgHolder" id="errorMsg">
  <div class="errorMSG" id="errorMsg1">
    <h1>Error</h1>
    <p>Account already exists</p>
  </div>
</div>

<script>
  var overlay = document.getElementById("addSalesReport");
  var errorMsg = document.getElementById("errorMsg");
  var errorMsg1 = document.getElementById("errorMsg1");
  var addSalesReport = document.getElementById("addSalesReport");

  function showAdd() {
    addSalesReport.style.display = "block";
  }
  function closeAddSalesReport() {
    addSalesReport.style.display = "none";
  }
  window.onclick = function (event) {
    console.log(event.target);

    if (event.target == overlay) {
      overlay.style.display = 'none';
    }
    if (event.target == errorMsg) {
      errorMsg.style.display = 'none';
    }
    if (event.target == errorMsg1) {
      errorMsg.style.display = 'none';
    }
  }
</script>