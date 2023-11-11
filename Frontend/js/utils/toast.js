export default class Toast {
  constructor(messageSpan, img, container) {
    this.messageSpan = messageSpan;
    this.img = img;
    this.container = container;
    this.time = 1500;
  }

  showToast(message, type, time) {
    this.messageSpan.textContent = message;
    this.container.style.opacity = '1';

    switch (type) {
      case "success":
        this.img.src = "../assets/svg/check.svg";
        this.container.style.backgroundColor = "#10e047";
        this.container.style.borderColor = "#10e047";
        this.container.style.color = "#fff";
        break;
      case "fail":
        this.img.src = "../assets/svg/fail.svg";
        this.container.style.backgroundColor = "#de1907";
        this.container.style.borderColor = "#de1907";
        this.container.style.color = "#fff";
        break;
    }

    const timeUp = time === undefined ? this.time : time;

    this.hideToast(timeUp);
  }

  hideToast(time) {
    setTimeout(() => {
      this.container.style.opacity = '0';
    }, time);
  }

  success(message, time) {
    this.showToast(message, "success", time);
  }
  fail(message, time) {
    this.showToast(message, "fail", time);
  }
}
