document.querySelector('.needs-validation').addEventListener('submit', function (event) {
  if (!this.checkValidity()) {
    event.preventDefault();
    event.stopPropagation();
  }

  var phoneNumberInput = document.getElementById('inputNumber4');
  var phoneFeedback = document.getElementById('phoneFeedback');
  var phoneEmptyFeedback = document.getElementById('phoneEmptyFeedback');

  if (!phoneNumberInput.value) {
    // Nếu trống, hiển thị thông báo khi trống
    phoneNumberInput.classList.add('is-invalid');
    phoneFeedback.style.display = 'none';
    phoneEmptyFeedback.style.display = 'block';
  } else if (!isValidPhoneNumber(phoneNumberInput.value)) {
    // Nếu không hợp lệ, hiển thị thông báo khi nhập sai
    phoneNumberInput.classList.add('is-invalid');
    phoneEmptyFeedback.style.display = 'none';
    phoneFeedback.style.display = 'block';
  } else {
    // Nếu hợp lệ, ẩn thông báo và xóa lớp 'is-invalid'
    phoneNumberInput.classList.remove('is-invalid');
    phoneEmptyFeedback.style.display = 'none';
    phoneFeedback.style.display = 'none';
  }

  this.classList.add('was-validated');
});

function isValidPhoneNumber(phoneNumber) {
  var phoneRegex = /^[0-9]{10,10}$/;
  return phoneRegex.test(phoneNumber);
}

var citySelect = document.getElementById("city");
var districtSelect = document.getElementById("district");

var Parameter = {
  url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
  method: "GET",
  responseType: "json",
};

var promise = axios(Parameter);

promise.then(function (result) {
  renderCity(result.data);
});

function renderCity(data) {
  // Clear existing options
  citySelect.innerHTML = '<option selected value="">Chọn Tỉnh/Thành phố của bạn</option>';
  districtSelect.innerHTML = '<option selected value="">Chọn Quận/Huyện của bạn</option>';

  // Populate city options
  for (const city of data) {
    citySelect.options[citySelect.options.length] = new Option(city.Name, city.Id);
  }

  // City onchange event
  citySelect.onchange = function () {
    districtSelect.length = 1; // Clear existing district options
    if (this.value !== "") {
      const selectedCity = data.find(n => n.Id === this.value);

      if (selectedCity && selectedCity.Districts) {
        // Populate district options
        for (const district of selectedCity.Districts) {
          districtSelect.options[districtSelect.options.length] = new Option(district.Name, district.Id);
        }
      }
    }
  };
}
