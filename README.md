#Shopify with Nexmo SMS

<img src="https://github.com/AdvaiyaLabs/Shopify-with-Nexmo-SMS/blob/master/docs/image1.png" width="200">

## Introduction
============

**Shopify with Nexmo SMS** app provides extended notification feature in Shopify. Shopify admin and customers can receive notifications on their mobile via SMS. Shopify with Nexmo SMS allows to send *order create, order fulfilment, order cancel, order delete* and *order payment* notifications via SMS to store admin and customers. Shopify admin can configure webhooks, which require SMS notification, and they can also set threshold amount so that the notification will only be sent if the order amount satisfies the threshold value.

## Use Case
========

SMS to Store Owner when any new order is placed or an order status is changed on Shopify store. 

Whenever any new order is placed by the customer, the app will immediately send an SMS to the owner with the order id and the total order amount. The SMS should be sent by the app only when the order amount is more than the specified amount threshold.

Shopify with Nexmo SMS will send SMS on the occurrence of the following events: 

1.  **Order Create**:  

    1.  **For Store Owner:** The order &lt;&lt;order\_number&gt;&gt; is created of &lt;&lt;amount&gt;&gt; by &lt;&lt;first\_name last\_name&gt;&gt;. 

2.  **Order Fulfillment**:  

    1.  **For Store Owner: ** The order &lt;&lt;order\_number&gt;&gt; is fulfilled for &lt;&lt;customer name&gt;&gt;. 

    2.  **For Customer:  ** The order &lt;&lt;order\_number&gt;&gt; is fulfilled by &lt;&lt;vendor\_name&gt;&gt;. 

3.  **Order Cancelled**: 

    1.  **For Store Owner:** The order &lt;&lt;order\_number&gt;&gt; has been cancelled. 

    2.  **For Customer:**  The order &lt;&lt;order\_number&gt;&gt; has been cancelled at &lt;&lt;vendor\_name&gt;&gt;. 

4.  **Order Delete**

    1.  **For Store Owner:** The order &lt;&lt;order\_number&gt;&gt; has been deleted.

5.  **Order Paid**:  

    1.  **For Store owner:** The payment of order &lt;&lt;order\_number&gt;&gt; of &lt;&lt;amount&gt;&gt; is received. 

## Prerequisites 
=============

-   Shopify Store account

-   Nexmo subscription and corresponding Nexmo API keys (Keys and Secret). To access the API keys, see appendix section.

-   Host with LAMP installed

## Features
========

-   Send SMS on the order status change

-   Send SMS to both the store owner and the customer when the threshold condition is fulfilled

-   Real time notifications

## Steps to deploy Shopify with Nexmo SMS
======================================

1.  Go to the [***https://github.com/nexmo-apps/shopify.git***](https://github.com/nexmo-apps/shopify.git) to download the app code, as shown below:

    <img src="https://github.com/AdvaiyaLabs/Shopify-with-Nexmo-SMS/blob/master/docs/image2.png" width="400">

2.  Download the package by clicking on **Download ZIP.**

3.  Extract the app code.

4.  Host the downloaded app code using ftp or any other medium.

5.  The hosted code must be accessible publically as internal and localhost will not work for this app.

## Create Webhook URL using Shopify with Nexmo SMS
===============================================

1.  Access the Shopify with Nexmo SMS using public URL.

> <img src="https://github.com/AdvaiyaLabs/Shopify-with-Nexmo-SMS/blob/master/docs/image3.PNG" width="400">

1.  Provide the correct Nexmo Key and Secret and click on **Validate**.

2.  The below screen will be shown on the successful validation of Nexmo keys.

> <img src="https://github.com/AdvaiyaLabs/Shopify-with-Nexmo-SMS/blob/master/docs/image4.PNG" width="400">

-   Select the **From Number** from the dropdown list.

-   Set the **Threshold Value** in number. It will send an SMS when any order is greater or equal to the threshold value.

-   Set the **Store Name** of online store.

-   Set **Store Owner Mobile Number** where you want to receive the message when the threshold condition gets satisfied.

-   Click on **Get** **Webhook.**

1.  Copy the webhook URLs which you want to integrate with Shopify events. <img src="https://github.com/AdvaiyaLabs/Shopify-with-Nexmo-SMS/blob/master/docs/image5.PNG" width="400">

2.  You can edit the webhook URLs by clicking on **Back**

3.  Once you configure webhook URLs with your Shopify store, then the SMS will be sent according to the configured webhooks.

## Steps to use webhook URL
========================

1.  Login to the Shopify store admin section.

    <img src="https://github.com/AdvaiyaLabs/Shopify-with-Nexmo-SMS/blob/master/docs/image6.PNG" height="400">

2.  Successful login will lead to a menu bar in the left side of the screen. Click on **Settings.**

    <img src="https://github.com/AdvaiyaLabs/Shopify-with-Nexmo-SMS/blob/master/docs/image7.PNG" heigth="400">

3.  In the settings section, click on **Notifications.**

    <img src="https://github.com/AdvaiyaLabs/Shopify-with-Nexmo-SMS/blob/master/docs/image8.PNG" heigth="400">

4.  In the notification section, go to webhook section and scroll to the bottom.

5.  Click on **Create a webhook** to create a new webhook.

    <img src="https://github.com/AdvaiyaLabs/Shopify-with-Nexmo-SMS/blob/master/docs/image9.PNG" width="400">

6.  A dialog **Add a Webhook** will appear.

7.  Select an **Event** *(select only those Events which are available in Shopify with Nexmo SMS).*

8.  Select Format as **JSON.**

9.  Paste the related webhook URL copied from Shopify with Nexmo SMS and click on **Save webhook** (It will be enabled once you have entered the URL).

    <img src="https://github.com/AdvaiyaLabs/Shopify-with-Nexmo-SMS/blob/master/docs/image10.PNG" width="400">

10. Once the webhook is created, you can test notifications by clicking **send test notification** and can remove the notification by clicking the delete icon.

    <img src="https://github.com/AdvaiyaLabs/Shopify-with-Nexmo-SMS/blob/master/docs/image11.PNG" width="600">

11. **send test notification** will not work for the order payment and the order delete event. It will work on live environment/test environment.

## Appendix
========

Nexmo API Keys
--------------

1.  Login to Nexmo.

2.  In the top right corner, click on **Api Settings.**

3.  Key and Secret will display in the top bar as shown in the below image:

> <img src="https://github.com/AdvaiyaLabs/Shopify-with-Nexmo-SMS/blob/master/docs/image12.jpeg">

Limitations
-----------

-   Shopify with Nexmo SMS is hosted on your server, so the webhook cannot be created automatically.
