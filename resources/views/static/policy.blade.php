@extends('layouts.app')
@section('content')
<html>
<style>
    .div {
        margin-top: 20px;
    }

    .sign_up_main {

    }

    .sign_up_wrap {
        width:100%;
        text-align: center;
        margin-top: 10px;
        padding: 0px 20px 0px 20px;
        font-weight: bold;
        font-size: 24px;
    }

    .sign_up_link_wrap {
        width:100%;
        text-align: center;
        padding:0px;
        font-weight: bold;
        clear:both;
    }

    .sign_up_links {
        width:50%;
        text-align: center;
        margin-top: 20px;
        padding:5px;
        font-weight: bold;
        font-size: 16px;
        float:left;
    }

    .about_us_main,
    .workflow_main {
        width:100%;
        margin-top: 60px;
        margin-bottom: 20px;
    }

    .workflow_main {
        margin-top: 10px;
    }

    .about_us_wrap,
    .workflow_wrap {
        width:100%;
        padding:20px 20px 0px 40px;
        font-weight: bold;
        font-size: 24px;
    }

    .about_us_subcontent {
        margin-left: 20px;
        margin-top: 20px;
    }

    .about_us_subcontent span {
        font-weight: bold;
        padding-left: 20px;
    }

    .about_us_data {
        padding-left: 20px;
    }
    .sign_up_footer {
        margin-top: -10px;
        margin-bottom: 10px;
        text-align: center;
    }
</style>
<body>

<div class="container">
    <div class="row">
        <div class="about_us_wrap">Policy</div>

                <div class="about_us_subcontent">
                    <span>1. Contacting Jobzerdra </span><br/>
                        <div class="about_us_data"> If you have any questions or concerns or complaints about our Privacy Policy or our data collection or processing practices, or if you want to report any security violations to us, please contact us at the following address or phone number:
                        <br> <br>   
                        Jobzerdra, Inc. 38660 Lexington Street, CA 94536 support@Jobzerdra.com

                        </div>
                </div>

	            <div class="about_us_subcontent">
                    <span>2. User Consent</span><br/>
                    <div class="about_us_data">By submitting Personal Data through our Site or Service, you agree to the terms of this Privacy Policy and you expressly consent to the collection, use and disclosure of your Personal Data in accordance with this Privacy Policy.


                    </div>
                </div>

                <div class="about_us_subcontent">
                    <span>3. A Note About Children  </span><br/>
                        <div class="about_us_data">We do not intentionally gather Personal Data from visitors who are under the age of 13. If a child under 13 submits Personal Data to Jobzerdra and we learn that the Personal Data is the information of a child under 13, we will attempt to delete the information as soon as possible. If you believe that we might have any Personal Data from a child under 13, please contact us at help@Jobzerdra.com.

                        </div>
                </div>

                <div class="about_us_subcontent">
                    <span>4. A Note To Users Outside Of The United States  </span><br/>
                        <div class="about_us_data"> If you are a non-U.S. user of the Site, by visiting the Site and providing us with data, you acknowledge and agree that your Personal Data may be processed for the purposes identified in the Privacy Policy. In addition, your Personal Data may be processed in the country in which it was collected and in other countries, including the United States, where laws regarding processing of Personal Data may be less stringent than the laws in your country. By providing your data, you consent to such transfer.

                        </div>
                </div>

                <div class="about_us_subcontent">
                    <span>5. Information We Collect </span><br/><br>
                        <!-- <div class="about_us_data"> -->
                        <span>A. Information You Provide To Us </span>
                        <div class="about_us_data">
                                We collect Personal Data from you, such as your first and last name, location, phone number, gender, e-mail and mailing addresses, professional title, company name, employment history, education history, personal summary, and password.
                                We receive and store this information on your behalf, such as files and messages that you enter it on our website, send it to us, or provide it to us in any other way.
                                For example, depending on the services you use, we may collect:
                                Credit card number and billing information (for services requiring payment);
                                Your race, ethnicity, or gender, if you choose to provide it;
                                Information about your business, such as company name, company size and business type. 
                                <br>We may also collect Personal Data at other points in our Site.
                                </div>
                                <br>
                        <span>B. Information Via Technology</span>
                                <div class="about_us_data">
                                We also gather certain information automatically when you visit our site.
                                <br>Information Collected by Our Servers. To make our Site and Service more useful to you, our servers (which may be hosted by a third party service provider) collect information from you, including your browser type, operating system, Internet Protocol (“IP”) address (a number that is automatically assigned to your computer when you use the Internet, which may vary from session to session), domain name, and/or a date/time stamp for your visit and store it in log files. We use this information to analyze trends, administer the Site, track users’ movements around the Site, gather demographic information about our user base as a whole, and better tailor our Service to our users’ needs. We may use a person's IP address to generate aggregate, non-identifying information about how our Services are used.
                                <br>Cookies: We use cookies to analyze trends, administer websites, track users' movements around the website, and to gather demographic information about our user base as a whole. Cookies help personalize and maximize your online experience and time online, including for storing user preferences, improving search results and ad selection, and tracking user trends. Cookies are small pieces of information that a website sends to your computer’s hard drive while you are viewing the website. Cookies store bits of information that we use to help make our site work. Some cookies will remain on your computer after you have left our site. We also use web beacons (sometimes called pixels, clear GIFs or action tags) and JavaScript to receive a confirmation when you open an email if your computer supports this type of program. We may use this information to reduce or eliminate messages sent to a user.
                                <br>Google Analytics. We use Google Analytics to help analyze how users use the Site. Google Analytics uses Cookies to collect information such as how often users visit the Site, what pages they visit, and what other sites they used prior to coming to the Site. We use the information we get from Google Analytics only to improve our Site and Service. Google Analytics collects only the IP address assigned to you on the date you visit the Site, rather than your name or other personally identifying information. We do not combine the information generated through the use of Google Analytics with your Personal Data. Although Google Analytics plants a persistent Cookie on your web browser to identify you as a unique user the next time you visit the Site, the Cookie cannot be used by anyone but Google. Google’s ability to use and share information collected by Google Analytics about your visits to the Site is restricted by the Google Analytics Terms of Use and the Google Privacy Policy.
                                </div>
                                <br>
                        <span>C. Information Collected From Third Party Companies</span>
                        <div class="about_us_data">
                           We may receive Personal and/or Anonymous Data about you from companies that provide our Service by way of a co-branded or private-labeled website, companies that offer their products and/or services on our Site, and/or companies that otherwise collect such information. These third party companies may supply us with Personal Data. We may add this information to the information we have already collected from you via our Site in order to improve the Service we provide.

                        </div>
                </div>

                <div class="about_us_subcontent">
                    <span>6. How we Use Information </span><br/>
                        <div class="about_us_data">In general, information you submit to us is used either to respond to requests that you make, or to aid us in serving you better. We use your information in the following ways:<br><br>
                        <ul>
                            <li>facilitate the creation of and completion of your profile on our Site;</li>
                            <li>to enable you to contact us and for us to respond to you;
                            </li>
                            <li>improve the quality of experience when you interact with our Site and Service;
                            </li>
                            <li>to detect, investigate and prevent activities that may violate our policies or be illegal;</li>
                            <li>to provide products and services that enable users to network, post information on bulletin boards, view and compare profiles;
                            </li>
                            <li>send you a welcome e-mail to verify ownership of the e-mail address provided when your Account was created;
                            </li>
                            <li>send you administrative e-mail notifications, such as information about pending job offers, security or support and maintenance advisories;
                            </li>
                            <li>respond to your inquiries related to employment opportunities or other requests;</li>
                            <li>make telephone calls to you, from time to time, as a part of secondary fraud protection or to solicit your feedback;
                            </li>
                            <li>send you calendar invitations;</li>
                            <li>send newsletters, surveys, offers, and other promotional materials related to our Service and for other marketing purposes;</li>
                            <li>occasionally publish testimonials and comments received from users who have had positive experiences with our Service; and</li>
                            <li>to give search engines access to public information.</li>
                        </ul>
                        </div>
                </div>
                <div class="about_us_subcontent">
                    <span>7. Disclosure Of Your Personal Data</span><br/>
                        <div class="about_us_data">
                       We disclose your Personal Data as described below and as described elsewhere in this Privacy Policy.</div><br>
                       <span>A. Third Party Service Providers</span>
                       <div class="about_us_data">
                                We may share your Personal Data with third party service providers to: provide you with the Service that we offer you through our Site; to conduct quality assurance testing; to facilitate creation of accounts; to provide technical support; and/or to provide other services to Jobzerdra. These third party service providers are required not to use your Personal Data other than to provide the services requested by Jobzerdra</div><br>
                        <span>B. Corporate Restructuring</span>
                        <div class="about_us_data">
                                We may share some or all of your Personal Data in connection with or during negotiation of any merger, financing, acquisition or dissolution transaction or proceeding involving sale, transfer, divestiture, or disclosure of all or a portion of our business or assets. In the event of an insolvency, bankruptcy, or receivership, Personal Data may also be transferred as a business asset. If another company acquires our company, business, or assets, that company will possess the Personal Data collected by us and will assume the rights and obligations regarding your Personal Data as described in this Privacy Policy.
                                </div><br>
                        <span>C. Social Networking Sites</span>
                        <div class="about_us_data">
                                Our Service may enable you to post content to SNSs. If you choose to do this, we will provide information to such SNSs in accordance with your elections. You acknowledge and agree that you are solely responsible for your use of those websites and that it is your responsibility to review the terms of use and privacy policy of the third party provider of such SNSs. We will not be responsible or liable for: (i) the availability or accuracy of such SNSs; (ii) the content, products or services on or availability of such SNSs; or (iii) your use of any such SNSs.
                                </div><br>
                         <span>D. Other Disclosures</span>
                         <div class="about_us_data">
                                Regardless of any choices you make regarding your Personal Data (as described below), Jobzerdra may disclose Personal Data if it believes in good faith that such disclosure is necessary (a) in connection with any legal investigation; (b) to comply with relevant laws or to respond to subpoenas or warrants served on Jobzerdra; (c) to protect or defend the rights or property of Jobzerdra or users of the Site or Service; and/or (d) to investigate or assist in preventing any violation or potential violation of the law, this Privacy Policy, or our Terms of Use.
                                </div>

                        </div>
                   <div class="about_us_subcontent">
                    <span>8. Third Party Websites </span><br/>
                        <div class="about_us_data">Our Site may contain links to third party websites. When you click on a link to any other website or location, you will leave our Site and go to another site, and another entity may collect Personal Data or Anonymous Data from you. We have no control over, do not review, and cannot be responsible for, these outside websites or their content. Please be aware that the terms of this Privacy Policy do not apply to these outside websites or content, or to any collection of your Personal Data after you click on links to such outside websites. We encourage you to read the privacy policies of every website you visit. The links to third party websites or locations are for your convenience and do not signify our recommendation of such third parties or their products, content or websites.

                        </div>
                </div>
                <div class="about_us_subcontent">
                    <span>9. Your Choices Regarding Information </span><br/>
                        <div class="about_us_data">
						<p>We offer you choices regarding the collection, use and sharing of your Personal Data and we'll respect the choices you make. Please note that if you decide not to provide us with the Personal Data that we request, you may not be able to access all of the features of the Services.
                        <br>Opt-Out: We may periodically send you free newsletters and e-mails that directly promote our Services. When you receive such promotional communications from us, you will have the opportunity to "opt-out" (either through your Account or by following the unsubscribe instructions provided in the e-mail you receive). We do need to send you certain communications regarding the Services and you will not be able to opt out of those communications – e.g., communications regarding updates to our Terms of Service or this Privacy Policy or information about billing.
                        <br>Modifying Your Information: If you want us to delete your Personal Data and your Account or to make any other modification in your account, please contact us at support@Jobzerdra.com with your request. We'll take steps to delete your information as soon we can, but some information may remain in archived/backup copies for our records or as otherwise required by law. If you are a Candidate, you can access and modify the Personal Data associated with your Account by accessing the Account and updating the information.


                        </div>
                </div>
                <div class="about_us_subcontent">
                    <span>10. Security Of Your Personal Data</span><br/>
                        <div class="about_us_data">
						No method of transmission over the Internet, or method of electronic storage, is 100% secure. Therefore, while Jobzerdra uses reasonable efforts to protect your Personal Data, Jobzerdra cannot guarantee its absolute security.


                        </div>
                </div>
                <div class="about_us_subcontent">
                    <span>11. Changes To This Privacy Policy</span><br/>
                        <div class="about_us_data">
                       This Privacy Policy may be updated from time to time for any reason. If we do so, we'll update “Revised On” date.. You should consult this Privacy Policy regularly for any changes. Continued use of our Site or Service, following posting of such changes, shall indicate your acknowledgement of such changes and agreement to be bound by the terms of such changes.


                        </div>
                </div>
                <div class="about_us_subcontent">
                    <span></span><br/>
                        <div class="about_us_data">
                    
                        </div>
                </div>

     </div>
     </div>
</div>
     </body>
</body>
</html>
@endsection