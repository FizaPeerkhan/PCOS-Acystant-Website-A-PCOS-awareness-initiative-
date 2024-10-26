document.addEventListener('DOMContentLoaded', () => {
    const steps = document.querySelectorAll('.quiz-step');
    let currentStep = 0;

    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            step.classList.toggle('active', index === stepIndex);
        });
    }

    showStep(currentStep);

    document.querySelectorAll('.next-btn').forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        });
    });

    document.querySelectorAll('.prev-btn').forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });
    });

    document.getElementById('quiz-form').addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent the default form submission

        // Collect responses from the form
        const form = document.getElementById('quiz-form');
        const formData = new FormData(form);

        // Check if all questions are answered
        let allAnswered = true;
        for (let i = 1; i <= steps.length; i++) {
            if (!formData.has(`q${i}`)) {
                allAnswered = false;
                break;
            }
        }

        if (!allAnswered) {
            alert("Please answer all questions before submitting.");
            return; // Stop the submission if not all questions are answered
        }

        // Store answers
        let answers = {};
        formData.forEach((value, key) => {
            answers[key] = value;
        });

        // Initialize a score variable
        let score = 0;

        // Check answers and calculate score
        for (const [question, answer] of Object.entries(answers)) {
            if (answer === 'yes') {
                score++;
            }
        }

        // Determine result based on score
        let resultText;
        if (score === 0) {
            resultText = "Based on your answers, you may not have PCOS symptoms.";
        } else if (score >= 1 && score <= 3) {
            resultText = "You have some symptoms of PCOS. It might be worth consulting with a healthcare provider.";
        } else if (score >= 4 && score <= 6) {
            resultText = "You have multiple symptoms of PCOS. We recommend seeing a healthcare provider for a professional diagnosis.";
        } else if (score >= 7 && score <= 10) {
            resultText = "You have several symptoms associated with PCOS. Please consult a healthcare provider for a thorough evaluation.";
        }

        // Display the result
        const resultDiv = document.getElementById('result');
        resultDiv.textContent = resultText;
    });
});
