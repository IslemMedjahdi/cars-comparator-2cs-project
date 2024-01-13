<?php
require_once __DIR__ . "/SharedUserView.php";

class CompanyView extends SharedUserView
{
    public function displayCompanyPage()
    {
        $this->displayHeader();
        $this->displayHorizontalMenu();
        $this->displayTermsOfUse();
        $this->displayPrivacyPolicy();
        $this->displayFooter();

    }

    public function displayTermsOfUse()
    {
        $settingsController = new SettingsController();
        $settings = $settingsController->getContent()["data"];
        $title = $settings['title'];
        ?>
        <div class="d-flex justify-content-center align-items-center flex-column" id="terms-of-use">
            <div class="mt-4">
                <h2 class="head">Terms Of Use</h2>
            </div>
            <div class=" mt-4" style="max-width: 1377px;">
                <div class="bg-light p-4 border w-100">
                    <p style="white-space: pre-wrap;width: 100%;">
                        By accessing or using the Service, you agree to be bound by these Terms. If you disagree with any part
                        of the terms, then you may not access the Service.

                        1. Acceptance of Terms
                        By accessing the Service, you agree to be bound by these Terms, all applicable laws, and regulations. If
                        you do not agree with any of these terms, you are prohibited from using or accessing this site.

                        2. Use License
                        Permission is granted to temporarily download one copy of the materials (information or software) on
                        <?= $title ?>'s website for personal, non-commercial transitory viewing only. This is the grant of
                        a license, not a transfer of title.
                        This license shall automatically terminate if you violate any of these restrictions and may be
                        terminated by
                        <?= $title ?> at any time. Upon terminating your viewing of these materials or upon
                        the termination of this license, you must destroy any downloaded materials in your possession whether in
                        electronic or printed format.
                        3. User Account
                        To access certain features of the Service, you may be required to provide information about yourself.
                        You agree that any information you provide will always be accurate, correct, and up-to-date.
                        You are responsible for maintaining the confidentiality of your account and password, including but not
                        limited to the restriction of access to your computer and/or account. You agree to accept responsibility
                        for any and all activities or actions that occur under your account and/or password.
                        4. Prohibited Uses
                        You may not:

                        Use the Service for any illegal purpose or in violation of any local, state, national, or international
                        law;
                        Harass, abuse, or harm another person;
                        Interfere with or disrupt the Service or servers or networks connected to the Service;
                        Attempt to gain unauthorized access to the Service, user accounts, or computer systems or networks
                        connected to the Service through hacking, password mining, or any other means.
                        5. Content
                        The Service allows you to post, link, store, share, and otherwise make available certain information,
                        text, graphics, videos, or other material. You are responsible for the content you post on the Service.

                        6. Disclaimer
                        The materials on the Service are provided on an 'as is' basis.
                        <?= $title ?> makes no warranties,
                        expressed or implied, and hereby disclaims and negates all other warranties including, without
                        limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or
                        non-infringement of intellectual property or other violation of rights.

                        7. Limitations
                        In no event shall
                        <?= $title ?> or its suppliers be liable for any damages (including, without
                        limitation, damages for loss of data or profit, or due to business interruption) arising out of the use
                        or inability to use the materials on
                        <?= $title ?>'s website, even if
                        <?= $title ?> or a
                        <?= $title ?> authorized representative has been notified orally or in writing of the possibility
                        of such damage.

                        8. Revisions and Errata
                        The materials appearing on the Service could include technical, typographical, or photographic errors.
                        <?= $title ?> does not warrant that any of the materials on its website are accurate, complete, or
                        current.

                        9. Links
                        <?= $title ?> has not reviewed all of the sites linked to its website and is not responsible for
                        the contents of any such linked site. The inclusion of any link does not imply endorsement by [Your
                        Company Name] of the site. Use of any such linked website is at the user's own risk.

                        10. Modifications to Terms of Use
                        <?= $title ?> may revise these terms of use for its website at any time without notice. By using
                        this website, you are agreeing to be bound by the then-current version of these Terms.

                        By using this website, you signify your acceptance of these Terms. If you do not agree to these Terms,
                        please do not use our website.
                    </p>
                </div>
            </div>
        </div>
        <?php
    }

    public function displayPrivacyPolicy()
    {
        $settingsController = new SettingsController();
        $settings = $settingsController->getContent()["data"];
        $title = $settings['title'];
        ?>
        <div class="d-flex justify-content-center align-items-center flex-column" id="privacy-policy">
            <div class="mt-4">
                <h2 class="head">Privacy Policy</h2>
            </div>
            <div class="mt-4" style="max-width: 1377px;">
                <div class="bg-light p-4 border">
                    <p style="white-space: pre-wrap;width: 100%;">
                        This Privacy Policy governs the manner in which
                        <?= $title ?> collects, uses, maintains and discloses information collected from users (each, a
                        "User") of the
                        <?= $title ?> website ("Site"). This privacy policy applies to the Site and all products and
                        services offered by
                        <?= $title ?>.

                        1. Personal identification information
                        We may collect personal identification information from Users in a variety of ways, including, but not
                        limited to, when Users visit our site, register on the site, place an order, fill out a form, respond
                        to a survey, subscribe to the newsletter and in connection with other activities, services, features
                        or resources we make available on our Site. Users may be asked for, as appropriate, name, email
                        address, mailing address, phone number, credit card information,
                        social security number. Users may, however, visit our Site anonymously. We will collect personal
                        identification information from Users only if they voluntarily submit such information to us. Users
                        can always refuse to supply personally identification information, except that it may prevent them
                        from engaging in certain Site related activities.

                        2. Non-personal identification information
                        We may collect non-personal identification information about Users whenever they interact with our
                        Site. Non-personal identification information may include the browser name, the type of computer and
                        technical information about Users means of connection to our Site, such as the operating system and
                        the Internet service providers utilized and other similar information.

                        3. Web browser cookies
                        Our Site may use "cookies" to enhance User experience. User's web browser places cookies on their
                        hard drive for record-keeping purposes and sometimes to track information about them. User may
                        choose to set their web browser to refuse cookies, or to alert you when cookies are being sent. If
                        they do so, note that some parts of the Site may not function properly.

                        4. How we use collected information
                        <?= $title ?> may collect and use Users personal information for the following purposes:

                        To improve customer service
                        Information you provide helps us respond to your customer service requests and support needs more
                        efficiently.

                        To personalize user experience
                        We may use information in the aggregate to understand how our Users as a group use the services and
                        resources provided on our Site.

                        To improve our Site
                        We may use feedback you provide to improve our products and services.
                    </p>
                </div>
            </div>
        </div>
        <?php
    }
}
?>