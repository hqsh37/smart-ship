
<div class="container main">
    <!-- MAIN -->


    <div class="slider-main">
        <div class="c">

            <input type="radio" name="a" id="cr-1" checked>
            <label for="cr-1" style="--hue: 32"></label>
            <div class="ci" style="--z: 4">
                <h2 class="ch" style="--h: 32; --s: 80%; --l: 90%">Giao hàng đa phương tiện!</h2>
                <img src="./assets/img/home1.jpg" alt="Snow on leafs">
            </div>

            <input type="radio" name="a" id="cr-2">
            <label for="cr-2" style="--hue: 82"></label>
            <div class="ci" style="--z: 3">
                <h2 class="ch" style="--h: 82; --s: 80%; --l: 90%">An toàn!</h2>
                <img src="./assets/img/home2.jpg" alt="Trees">
            </div>

            <input type="radio" name="a" id="cr-3">
            <label for="cr-3" style="--hue: 40"></label>
            <div class="ci" style="--z: 2">
                <h2 class="ch" style="--h: 40; --s: 100%; --l: 89%">Nhanh chóng!</h2>
                <img src="./assets/img/home3.jpg" alt="Mountains and houses">
            </div>

            <input type="radio" name="a" id="cr-4">
            <label for="cr-4" style="--hue: 210"></label>
            <div class="ci" style="--z: 1">
                <h2 class="ch" style="--h: 210; --s: 70%; --l: 90%">Tiện lợi!</h2>
                <img src="./assets/img/home4.jpeg" alt="Sky and mountains">
            </div>
        </div>
    </div>

    <div class="card-info container">
        <div class="card" style="width: 18rem;">
            <img src="./assets/img/vanchuyen.jpg" class="card-img-top" alt="card info">
            <div class="card-body">
                <h5 class="card-title">Vận Chuyển Nhanh Chóng và An Toàn</h5>
                <p class="card-text">Dịch vụ giao hàng thông minh của chúng tôi không chỉ đảm bảo tốc độ vận chuyển
                    nhanh chóng mà còn đảm bảo an toàn cho hàng hóa của bạn. Chúng tôi áp dụng các biện pháp bảo vệ hàng
                    hóa một cách cẩn thận và sử dụng các phương tiện vận chuyển hiện đại, giúp giảm thiểu rủi ro và đảm
                    bảo hàng hóa của bạn được giao đến đích một cách an toàn nhất.</p>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="./assets/img/thongminh.jpg" class="card-img-top" alt="card info">
            <div class="card-body">
                <h5 class="card-title">Đội Ngũ Nhân Viên Chuyên Nghiệp</h5>
                <p class="card-text">Với đội ngũ nhân viên giàu kinh nghiệm và chuyên môn cao, chúng tôi luôn sẵn lòng
                    hỗ trợ bạn trong mọi tình huống. Tận tâm và chu đáo, đội ngũ của chúng tôi sẽ đảm bảo quá trình giao
                    nhận hàng diễn ra một cách suôn sẻ và hiệu quả nhất, từ quá trình đóng gói đến việc giao nhận hàng
                    hóa.</p>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="./assets/img/congnghe.jpg" class="card-img-top" alt="card info">
            <div class="card-body">
                <h5 class="card-title">Công Nghệ Tiên Tiến</h5>
                <p class="card-text">Chúng tôi luôn cập nhật và áp dụng công nghệ tiên tiến nhất trong hoạt động của
                    mình. Điều này giúp tối ưu hóa quy trình vận chuyển, từ việc quản lý đơn hàng đến việc theo dõi vị
                    trí của hàng hóa trong thời gian thực. Với sự kết hợp hoàn hảo giữa con người và công nghệ, chúng
                    tôi cam kết mang đến cho bạn trải nghiệm giao hàng thông minh và tiện lợi nhất.</p>
            </div>
        </div>
    </div>

    <div class="map container">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.375468702126!2d106.6923911!3d10.859020400000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752839152bcdf1%3A0xf600077c23b5d684!2zMjcgVsaw4budbiBMw6BpLCBBbiBQaMO6IMSQw7RuZywgUXXhuq1uIDEyLCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmg!5e0!3m2!1sen!2s!4v1710739870194!5m2!1sen!2s"
            height="550" style="border: 0px; visibility: visible; animation-name: fadeIn;width: 90%;" allowfullscreen=""
            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

</div>

<script>
// slider
let slideIndex = 0; // Start with the first card
showSlides();

function showSlides() {
    let slides = document.querySelectorAll('.c input[type="radio"][name="a"]');
    slideIndex++;
    if (slideIndex >= slides.length) {
        slideIndex = 0; // Reset index to loop back to the first card
    }
    slides[slideIndex].checked = true; // Check the next radio button
    setTimeout(showSlides, 5000); // Change slide every 5 seconds
}
</script>