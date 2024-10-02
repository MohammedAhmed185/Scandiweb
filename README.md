# Scandiweb

# Technical Documentation

## Overview
This document outlines the system architecture and design patterns employed in the development of the application, which follows the MVC (Model-View-Controller) architecture. The frontend utilizes PHP, HTML, and CSS, while MySQL is leveraged for backend data management. The system also incorporates several design patterns, including Strategy, Factory, and Singleton, to ensure code modularity and reusability.

## System Architecture

1. **Frontend**: The frontend is developed using PHP for dynamic content generation, HTML for structuring the web pages, and CSS for styling and layout.
2. **Backend**: The backend follows the MVC architecture, with PHP managing server-side logic. This structure promotes clean, modular, and maintainable code.
3. **Database**: MySQL is used as the database management system to store, retrieve, and manage data efficiently.

## Design Patterns

### Singleton Pattern
- **Objective**: Ensures that only a single instance of a class exists within the application.
- **Application**: This pattern is employed for managing the database connection, ensuring that only one connection is active at any given time.

### Factory Pattern
- **Objective**: Facilitates object creation without specifying the exact class of the object to be instantiated.
- **Application**: This pattern is used for generating various types of entities or products within the system.

### Strategy Pattern
- **Objective**: Provides a way to define a family of algorithms, encapsulate each one, and make them interchangeable as needed.
- **Application**: This pattern is used to implement business logic strategies that can be dynamically swapped depending on the requirements.

## Backend Implementation

### Model
- **Function**: The Model represents the data layer and business logic of the application. It handles interactions with the database and ensures data validation.
- **Structure**: The Model consists of classes representing different entities, where an abstract base class defines common properties and methods, and concrete subclasses extend it for specific entities.

### Controller
- **Function**: The Controller manages incoming client requests, processes them, and determines the appropriate response.
- **Implementation**: Controllers receive HTTP requests, interact with the Model to manipulate or retrieve data, and then pass the relevant information to the Views for rendering.

### View
- **Function**: The View is responsible for rendering the user interface and presenting data.
- **Implementation**: It uses PHP, HTML, and CSS to display the data provided by the Controllers, ensuring a consistent and user-friendly interface.

## Client-Side Implementation

- **PHP**: Facilitates server-side logic and the generation of dynamic web content.
- **HTML**: Structures the layout of web pages.
- **CSS**: Provides styling and design for the web pages, ensuring a visually appealing and responsive user interface.

## Database Implementation

### MySQL
- **Function**: MySQL serves as the database management system, overseeing data storage, retrieval, and manipulation to ensure efficient data handling throughout the application.

