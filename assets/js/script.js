let currentStep = 1;

            function nextStep(step) {
                document.getElementById('step' + step).classList.remove('active');
                document.getElementById('step' + (step + 1)).classList.add('active');
                document.getElementById('step' + step + '-indicator').classList.remove('active');
                document.getElementById('step' + (step + 1) + '-indicator').classList.add('active');
                currentStep++;
            }

            function prevStep(step) {
                document.getElementById('step' + step).classList.remove('active');
                document.getElementById('step' + (step - 1)).classList.add('active');
                document.getElementById('step' + step + '-indicator').classList.remove('active');
                document.getElementById('step' + (step - 1) + '-indicator').classList.add('active');
                currentStep--;
            }
            let slideIndex = 0;
        showSlides();
        function showSlides() {
            let slides = document.getElementsByClassName("slides");
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1;
            }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 3000); 
        }