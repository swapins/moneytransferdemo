# Money Transfer Business - Laravel 10 PHP Skill Demonstartion

In this Demonstartion, i have created a Laravel application for a money transfer business. The application have an admin panel with the following features:

## Feature 1: Configuring Sending and Receiving Countries

In the admin panel, the admin should be able to configure which countries can be activated and deactivated as sending and receiving countries. For example, if the home page displays Sending countries as UK and US, the admin should be able to deactivate any country, such as US, from the backend, and it should reflect on the front end. So, only one country (UK) will be shown in the sending countries list. Similarly, the list of receiving countries should also be configurable from the backend.

## Feature 2: Static Rate and Customised Rate

In the admin panel, there should be options to configure both static rates and customized rates. The customised rate will depend on the static rate, either as a fixed value or a percentage.

For example:
- Sending country: UK
- Receiving country: India
- Static rate: 100.00 rupees per pound
- Customised rate: -5 (or -5%)

In this case, the home page should display the conversion rate as 95.00 rupees per pound.

Similarly:
- Sending country: US
- Receiving country: Pakistan
- Static rate: 286.00 rupees
- Customised rate: +3 (or +3%)

In this case, the home page should display the conversion rate as 289.00 rupees.

## Feature 3: API Integration for Retrieving List of Nations and Details

As an additional feature and to showcase my skills, I have integrated an API call to retrieve a list of nations and their details for future functionalities in the money transfer business application.

**How it works:**

1. When accessing the admin panel or a specific section related to managing countries, the application will make an API call to a reliable and up-to-date external API service that provides information about nations.

2. The API response will include a list of nations along with relevant details such as country names, ISO codes, currencies, time zones, and other essential information.

3. This retrieved data can then be utilized to populate the country selection dropdowns, display relevant nation details, and facilitate various currency-related operations.

**Benefits:**

1. Real-time Data: By using an API, the application ensures that it always has the latest and most accurate information about countries and their details.

2. Scalability: As the API is maintained externally, the application can easily scale without the need for manual updates to the country data.

3. Reduced Development Time: Integrating an existing API for country data saves development time and resources, allowing the focus to be on other core functionalities of the application.

4. Data Consistency: The application will maintain consistent and standardized data about nations, reducing the risk of data discrepancies.

**Future Functionality:**

The integration of this API lays the groundwork for future functionalities, such as:

- Currency Conversion: With up-to-date currency data from the API, the application can perform accurate and reliable currency conversions.

- Dynamic Country Selection: The admin can easily manage the list of sending and receiving countries through the admin panel, making it more user-friendly and flexible.

- Multi-Language Support: The application can use the API data to display country names and other details in multiple languages, improving the user experience for international users.

Please feel free to explore and test this API-integrated feature, and I am open to any feedback or further enhancements you may have in mind.




## Installation Guide

Follow the steps below to download the Laravel project from a Git repository and set it up on your local system:

### Prerequisites:

- PHP installed on your system (version compatible with Laravel 10).
- Composer installed on your system.
- Git installed on your system.

### Step 1: Clone the Git Repository

Open a terminal or command prompt and navigate to the directory where you want to download the project. Then, run the following command to clone the repository:

```bash
git clone <repository_url>
```

Replace `<repository_url>` with the actual URL of the Git repository.

### Step 2: Install Dependencies

After cloning the repository, navigate into the project directory using the following command:

```bash
cd money-transfer-app
```

Next, install the project dependencies using Composer:

```bash
composer install
```

### Step 3: Set Up Environment Configuration

Rename the `.env.example` file to `.env`:

- On Linux/macOS:

```bash
mv .env.example .env
```

- On Windows (Command Prompt):

```bash
ren .env.example .env
```

Generate a new application key:

```bash
php artisan key:generate
```

### Step 4: Configure the Database

Open the `.env` file and set the database connection details according to your environment:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### Step 5: Create Database Tables

Run the migrations to create the necessary database tables:

```bash
php artisan migrate
```

### Step 6: Run the Development Server

Start the Laravel development server to run the application:

```bash
php artisan serve
```

The application will be accessible at `http://localhost:8000` by default.

### Step 7: Register Admin Account

In your web browser, go to `http://localhost:8000/register` and complete the registration process to create an admin account. This account will be used to access the admin panel and configure sending and receiving countries, as well as static and customized rates.

### Step 8: Run Tests

```bash
php artisan test
```


I am now submitting the code for your review. I have implemented the features as per the requirements and integrated the admin panel functionalities along with the currency conversion logic.

If you have any feedback or suggestions for improvement, I would be more than happy to consider them. Please feel free to reach out to me at swapin@laravelone.in, and I'll be eagerly awaiting your response.

Once again, thank you for the opportunity, and I look forward to hearing from you soon.