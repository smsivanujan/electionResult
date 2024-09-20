<!DOCTYPE html>
<html>

<head>
    <title>Election Results</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        html,
        body,
        h1,
        h2,
        h3,
        h4 {
            font-family: "Lato", sans-serif
        }

        .mySlides {
            display: none
        }

        .w3-tag,
        .fa {
            cursor: pointer
        }

        .w3-tag {
            height: 15px;
            width: 15px;
            padding: 0;
            margin-top: 6px
        }
    </style>
</head>

<body>
    <!-- Content -->
    <div class="w3-content" style="max-width:1100px;margin-top:80px;margin-bottom:80px">
        <div class="w3-panel">
            <h1><b>Srilanka Presidential Election Result - 2024</b></h1>
            <p>Powerd By HUBIIS</p>
        </div>

        <!-- Slideshow -->
        <div class="w3-container">
            <div class="w3-display-container mySlides">
                <img src="{{ asset('images/basicImages/election-result-srilanka-2024.jpg') }}" style="width:100%; height:400px; object-fit:cover;">
                <div class="w3-display-topleft w3-container w3-padding-32">
                    <span class="w3-white w3-padding-large w3-animate-bottom">Srilanka Presidential Election-2024</span>
                </div>
            </div>

            <div class="w3-display-container mySlides">
                <img src="{{ asset('images/basicImages/presdental-election-2024.jpg') }}" style="width:100%; height:400px; object-fit:cover;">
                <div class="w3-display-middle w3-container w3-padding-32">
                    <span class="w3-white w3-padding-large w3-animate-bottom">Srilanka Presidential Election-2024</span>
                </div>
            </div>

            <div class="w3-display-container mySlides">
                <img src="{{ asset('images/basicImages/top-3-contender-fro-srilanka-presidential-election-2024.jpg') }}" style="width:100%; height:400px; object-fit:cover;">
                <div class="w3-display-topright w3-container w3-padding-32">
                    <span class="w3-white w3-padding-large w3-animate-bottom">Srilanka Presidential Election-2024</span>
                </div>
            </div>

            <!-- Slideshow next/previous buttons -->
            <div class="w3-container w3-dark-grey w3-padding w3-xlarge">
                <div class="w3-left" onclick="plusDivs(-1)"><i class="fa fa-arrow-circle-left w3-hover-text-teal"></i></div>
                <div class="w3-right" onclick="plusDivs(1)"><i class="fa fa-arrow-circle-right w3-hover-text-teal"></i></div>

                <div class="w3-center">
                    <span class="w3-tag demodots w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
                    <span class="w3-tag demodots w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
                    <span class="w3-tag demodots w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span>
                </div>
            </div>
        </div>

        <!-- Results Images -->
        <div class="w3-row w3-container" style="display: flex; height: 100vh;">
            <!-- Latest result display on the left side -->
            @if ($latestResult)
            <div style="flex: 3; padding: 20px; position: relative;">
                <h2>Latest Result</h2>
                <img src="{{ asset('images/' . $latestResult->image_path) }}" alt="Latest Election Result" style="width:100%; height:100%; object-fit:contain;">
                <div style="position: absolute; top: 10px; right: 10px; background: rgba(0, 0, 0, 0.7); color: white; padding: 5px; border-radius: 5px;">
                    {{ $latestResult->created_at->format('Y-m-d H:i:s') }}
                </div>
            </div>
            @endif

            <!-- Previous results display on the right side -->
            <div style="flex: 1; padding: 20px; overflow-y: auto; height: 100vh;">
                <h2>Previous Results</h2>
                <div class="previous-results" style="display: flex; flex-direction: column; gap: 20px;">
                    @foreach ($previousResults as $result)
                    <div style="position: relative;">
                        <img src="{{ asset('images/' . $result->image_path) }}" alt="Election Result" style="width:150px; height:150px; object-fit:cover; cursor:pointer;" onclick="openModal('{{ asset('images/' . $result->image_path) }}', '{{ $result->created_at->format('Y-m-d H:i:s') }}')">
                        <div style="position: absolute; top: 5px; right: 5px; background: rgba(0, 0, 0, 0.7); color: white; padding: 3px; border-radius: 5px;">
                            {{ $result->created_at->format('Y-m-d H:i:s') }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="w3-container w3-padding-32 w3-light-grey w3-center">
        <h4>Thank You For Your Visiting</h4>
        <a href="#" class="w3-button w3-black w3-margin"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
        <div class="w3-xlarge w3-section">
            <i class="fa fa-facebook-official w3-hover-opacity"></i>
            <i class="fa fa-instagram w3-hover-opacity"></i>
            <i class="fa fa-twitter w3-hover-opacity"></i>
        </div>
        <p>Powered by <a title="W3.CSS" target="_blank" class="w3-hover-text-green">sobiztech pvt ltd</a></p>
    </footer>

    <!-- Modal -->
    <div id="imageModal" style="display:none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.8);">
        <span onclick="closeModal()" style="position: absolute; top: 20px; right: 40px; font-size: 40px; color: white; cursor: pointer;">&times;</span>
        <img id="modalImage" style="display: block; margin: auto; max-width: 90%; max-height: 90%;">
        <div id="modalDate" style="text-align: center; color: white; margin-top: 10px;"></div>
    </div>

    <!-- JavaScript for Modal -->
    <script>
        function openModal(imageSrc, dateTime) {
            document.getElementById("modalImage").src = imageSrc;
            document.getElementById("modalDate").innerText = dateTime;
            document.getElementById("imageModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("imageModal").style.display = "none";
        }
    </script>


    <script>
        // Slideshow
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function currentDiv(n) {
            showDivs(slideIndex = n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demodots");
            if (n > x.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = x.length
            };
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" w3-white", "");
            }
            x[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " w3-white";
        }
    </script>

</body>

</html>