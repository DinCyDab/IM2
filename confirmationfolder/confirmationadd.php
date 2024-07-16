<style>
  .confirmationHolder {
    position: fixed;
    width: 100%;
    height: 100vh;
    background-color: rgba(0, 0, 0, .4);
    top: 0;
    left: 0;
    display: none;
    z-index: 3;
  }

  .confirmation {
    position: absolute;
    width: 30%;
    max-width: 400px;
    background-color: wheat;
    border-radius: 20px;
    padding: 20px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
  }

  .confirmation h1 {
    color: red;
  }

  .confirmation p {
    color: black;
    text-decoration: underline;
  }

  .confirmation button {
    margin: 10px;
  }
</style>

<div class="confirmationHolder" id="confirmationadd">
  <div class="confirmation" id="confirmation1">
    <h1>Are you sure you want to continue?</h1>
    <button onclick="submitAddForm()">YES</button>
    <button onclick="closeAddConfirmation()">NO</button>
  </div>
</div>

<script>
  var confirmationHolderAdd = document.getElementById("confirmationadd");
  var addform = document.getElementById("addform");

  function validateAddForm() {
    confirmationHolderAdd.style.display = "block";
    return false;
  }

  function closeAddConfirmation() {
    confirmationHolderAdd.style.display = "none";
  }

  function submitAddForm() {
    addform.submit();
  }

  window.onclick = function(event) {
    if (event.target == confirmationHolderAdd) {
      closeAddConfirmation();
    }
  };
</script>

