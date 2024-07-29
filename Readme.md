# MultiFunctionWebApp

MultiFunctionWebApp is a versatile web application combining user management, distance calculation between coordinates, and audio file length analysis. This project demonstrates skills in creating and updating user profiles, handling multimedia data, and performing geographical calculations.

## Features

- **User Management**: Create, update, and manage user profiles with validation and file upload capabilities.
- **Distance Calculation**: Calculate the distance between two geographical points using latitude and longitude.
- **Audio File Analysis**: Analyze and retrieve the length of various audio files.
- **Dynamic User Filtering**: Filter users by name, email, or mobile without requiring a page reload.

## Technologies Used

- **Backend**: CodeIgniter 4, PHP
- **Frontend**: HTML, CSS (Bootstrap), JavaScript
- **Database**: MySQL
- **File Uploads**: getID3 library for audio file analysis

## Setup Instructions

### Prerequisites

- PHP 7.4+
- Composer
- MySQL
- CodeIgniter 4

### Installation

1. **Clone the repository**:
    ```bash
    git clone https://github.com/Karan7426/MultiFunctionWebApp.git
    ```

2. **Navigate to the project directory**:
    ```bash
    cd MultiFunctionWebApp
    ```

3. **Install dependencies**:
    ```bash
    composer install
    ```

4. **Set up the database**:
    - Create a database in MySQL.
    - Configure the database settings in `app/Config/Database.php`.

5. **Run migrations**:
    ```bash
    php spark migrate
    ```

6. **Run the application**:
    ```bash
    php spark serve
    ```

### Usage

#### User Management

- **Create User**: Navigate to `/create` to add a new user.
- **Edit User**: Navigate to `/edit/{id}` to edit an existing user.
- **View User List**: Navigate to `/` to view the list of users.

#### Distance Calculation

- **Calculate Distance**: Access the distance calculation feature at `/calculate-distance`.

#### Audio File Analysis

- **Get Audio Length**: Analyze an audio file by accessing `/audio-length/{filename}`. Ensure the file is uploaded to the `uploads` directory.

#### Dynamic User Filtering

- **Filter Users**: Use the search box on the user list page to filter users by name, email, or mobile without reloading the page.

### Example

- To calculate the distance between two points:
    ```php
    public function calculateDistanceExample()
    {
        $lat1 = 40.748817;
        $lon1 = -73.985428;
        $lat2 = 34.052235;
        $lon2 = -118.243683;

        $distance = calculateDistance($lat1, $lon1, $lat2, $lon2);

        echo "The distance between the points is: " . $distance . " km";
    }
    ```

- To get the length of an audio file:
    ```php
    public function getAudioLengthExample($filePath)
    {
        $fullPath = FCPATH . 'uploads/' . $filePath . '.mp3';
        $audioLength = getAudioLength($fullPath);

        if ($audioLength !== false) {
            echo "The audio length is: " . $audioLength . " seconds";
        } else {
            echo "Failed to get the audio length.";
        }
    }
    ```

## License

This project is licensed under the MIT License.

## Contact

For any inquiries or feedback, please contact [karanchaudhary1101@gmail.com].
