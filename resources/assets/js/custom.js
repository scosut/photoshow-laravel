var firstError = document.getElementById('firstError');

if (firstError && firstError.value.length > 0) {
  document.forms[0][firstError.value].focus();
}

$(".bg-flex").css("display", "flex").hide().fadeIn(2000);