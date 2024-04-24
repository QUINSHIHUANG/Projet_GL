<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Interface</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('images/4712892.jpg'); /* Background image path */
            background-size: cover;
            background-position: center;
        }

        h1 {
            color: #333;
            text-align: center;
            padding: 20px 0;
            background-color: rgba(143, 244, 200, 0.6); /* Semi-transparent white background */
            margin: 0;
        }

        #requests-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.5); /* Semi-transparent white background */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .cv-link {
            display: none;
        }

        .view-cv-btn, .btn-accept, .btn-refuse {
            cursor: pointer;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 5px 10px;
            margin-top: 10px;
            display: block;
            text-align: center;
            width: 100px;
            margin: 0 auto;
        }

        .btn-refuse {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <h1>Admin Interface</h1>

    <div id="requests-container"></div>

    <script>
        // Sample data - replace this with data from your server
        const requests = [
            { id: 1, user: "User1", request: "Request details 1", status: "pending", cv: "CV_User1.pdf" },
            { id: 2, user: "User2", request: "Request details 2", status: "pending", cv: "CV_User2.pdf" },
            { id: 3, user: "User3", request: "Request details 3", status: "pending", cv: "CV_User3.pdf" },
        ];

        const requestsContainer = document.getElementById("requests-container");

        // Function to render requests
        function renderRequests() {
            requestsContainer.innerHTML = "";

            requests.forEach(request => {
                const card = document.createElement("div");
                card.classList.add("request-card");

                const viewCVBtn = document.createElement("button");
                viewCVBtn.classList.add("view-cv-btn");
                viewCVBtn.innerText = "View CV";
                viewCVBtn.addEventListener("click", () => viewCV(request.cv));

                const acceptBtn = document.createElement("button");
                acceptBtn.classList.add("btn-accept");
                acceptBtn.innerText = "Accept";
                acceptBtn.addEventListener("click", () => handleStatusChange(request, "accepted"));

                const refuseBtn = document.createElement("button");
                refuseBtn.classList.add("btn-refuse");
                refuseBtn.innerText = "Refuse";
                refuseBtn.addEventListener("click", () => handleStatusChange(request, "refused"));

                const cvLink = document.createElement("a");
                cvLink.classList.add("cv-link");
                cvLink.href = request.cv;
                cvLink.target = "_blank";
                cvLink.innerText = "CV";

                card.innerHTML = `
                    <div class="request-details">
                        <div class="user-info">
                            <p><strong>User:</strong> ${request.user}</p>
                            <p><strong>Request:</strong> ${request.request}</p>
                            <p><strong>Status:</strong> <span class="status-${request.status}">${request.status}</span></p>
                        </div>
                    </div>
                `;

                card.appendChild(viewCVBtn);
                card.appendChild(acceptBtn);
                card.appendChild(refuseBtn);
                card.appendChild(cvLink);

                requestsContainer.appendChild(card);
            });
        }

        // Function to handle status change
        function handleStatusChange(request, newStatus) {
            request.status = newStatus;
            renderRequests();
            // Send a request to your server to update the status in the database
        }

        // Function to open CV in a new tab
        function viewCV(cvUrl) {
            window.open(cvUrl, '_blank');
        }

        // Initial rendering
        renderRequests();
    </script>
</body>
</html>










