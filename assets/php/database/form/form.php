<form id="contactForm" method="POST" action="../../../../assets/php/database/form/form_processing.php" class="contact-form">
    <div class="form-group-row">
        <div class="form-group">
            <label for="name"><?= isset($trad['name']) ? $trad['name'] : 'Name' ?> *</label>
            <input type="text" id="name" name="name" required>
            <span class="error-message" id="nameError"></span>
        </div>
        
        <div class="form-group">
            <label for="email"><?= isset($trad['email']) ? $trad['email'] : 'Email' ?> *</label>
            <input type="email" id="email" name="email" required>
            <span class="error-message" id="emailError"></span>
        </div>
    </div>
    
    <div class="form-group">
        <label for="phone"><?= isset($trad['phone']) ? $trad['phone'] : 'Phone' ?></label>
        <input type="tel" id="phone" name="phone">
        <span class="error-message" id="phoneError"></span>
    </div>
    
    <div class="form-group">
        <label for="message"><?= isset($trad['message']) ? $trad['message'] : 'Message' ?> *</label>
        <textarea id="message" name="message" rows="5" required></textarea>
        <span class="error-message" id="messageError"></span>
    </div>
    
    <div class="form-group">
        <button type="submit" id="submitBtn"><?= isset($trad['submit']) ? $trad['submit'] : 'Submit' ?></button>
    </div>
    
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div class="success-message">
        <?= isset($trad['success']) ? $trad['success'] : 'Your message has been sent successfully!' ?>
    </div>
    <?php endif; ?>
    
    <?php if (isset($_GET['error'])): ?>
    <div class="error-message">
        <?= htmlspecialchars(urldecode($_GET['error'])) ?>
    </div>
    <?php endif; ?>
</form>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');
    const messageInput = document.getElementById('message');
    
    const nameError = document.getElementById('nameError');
    const emailError = document.getElementById('emailError');
    const phoneError = document.getElementById('phoneError');
    const messageError = document.getElementById('messageError');
    
    form.addEventListener('submit', function(event) {
        let isValid = true;

        nameError.textContent = '';
        emailError.textContent = '';
        phoneError.textContent = '';
        messageError.textContent = '';

        if (nameInput.value.trim().length < 2) {
            nameError.textContent = '<?= $trad['name_error'] ?>';
            isValid = false;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailInput.value.trim())) {
            emailError.textContent = '<?= $trad['email_error'] ?>';
            isValid = false;
        }

        if (phoneInput.value.trim() !== '') {
            const phoneRegex = /^[+]?[(]?[0-9]{3}[)]?[-\s.]?[0-9]{3}[-\s.]?[0-9]{4,6}$/;
            if (!phoneRegex.test(phoneInput.value.trim())) {
                phoneError.textContent = '<?= $trad['phone_error'] ?>';
                isValid = false;
            }
        }

        if (messageInput.value.trim().length < 10) {
            messageError.textContent = '<?= $trad['message_error'] ?>';
            isValid = false;
        }
        
        if (!isValid) {
            event.preventDefault();
        }
    });
});
</script>
