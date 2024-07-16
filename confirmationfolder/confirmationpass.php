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

  .updatedsuccessfully{
    position: fixed;
    width: 100%;
    height: 100vh;
    background-color: rgba(0, 0, 0, .4);
    top: 0;
    left: 0;
    display: none;
    z-index: 3;
  }
</style>

<div class="confirmationHolder" id="confirmationpass">
  <div class="confirmation">
    <h1>Are you sure you want to continue?</h1>
    <button onclick="submitPassForm()">YES</button>
    <button onclick="closeEditConfirmation()">NO</button>
  </div>
</div>

<script>
    var confirmationpass = document.getElementById("confirmationpass");

  function submitPassForm(){
    document.getElementById("passForm").submit();
  }

  function closeEditConfirmation(){
    confirmationpass.style.display = "none";
  }

</script>
