-- Dive Buddy Database Schema (PostgreSQL)
-- Run this against your PostgreSQL database to initialize the application.

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255),
    oauth_provider VARCHAR(50),
    oauth_id VARCHAR(255),
    name VARCHAR(100) NOT NULL,
    location VARCHAR(255),
    bio TEXT,
    certification_level VARCHAR(50),
    profile_image VARCHAR(255),
    is_active BOOLEAN DEFAULT true,
    is_admin BOOLEAN DEFAULT false,
    email_verified BOOLEAN DEFAULT false,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Dive sites table
CREATE TABLE IF NOT EXISTS dive_sites (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    country VARCHAR(100) NOT NULL,
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    description TEXT,
    max_depth INTEGER,
    difficulty VARCHAR(50),
    water_type VARCHAR(50),
    best_season VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Logged dives
CREATE TABLE IF NOT EXISTS dives (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
    dive_site_id INTEGER REFERENCES dive_sites(id) ON DELETE SET NULL,
    dive_date DATE NOT NULL,
    max_depth DECIMAL(5,2),
    bottom_time INTEGER,
    visibility DECIMAL(5,2),
    conditions VARCHAR(100),
    notes TEXT,
    is_public BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Dive participants (who was on a dive together)
CREATE TABLE IF NOT EXISTS dive_participants (
    id SERIAL PRIMARY KEY,
    dive_id INTEGER REFERENCES dives(id) ON DELETE CASCADE,
    user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
    role VARCHAR(50) DEFAULT 'participant',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(dive_id, user_id)
);

-- Ratings (rate dive partners 1-5 stars)
CREATE TABLE IF NOT EXISTS ratings (
    id SERIAL PRIMARY KEY,
    dive_id INTEGER REFERENCES dives(id) ON DELETE CASCADE,
    rated_user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
    rating_user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
    rating INTEGER CHECK (rating >= 1 AND rating <= 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(dive_id, rated_user_id, rating_user_id)
);

-- Site-wide configuration (admin)
CREATE TABLE IF NOT EXISTS site_configs (
    id SERIAL PRIMARY KEY,
    config_key VARCHAR(100) UNIQUE NOT NULL,
    config_value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sessions table (CodeIgniter database session handler)
CREATE TABLE IF NOT EXISTS ci_sessions (
    id VARCHAR(128) NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    timestamp INTEGER DEFAULT 0 NOT NULL,
    data BYTEA NOT NULL,
    PRIMARY KEY (id)
);

CREATE INDEX IF NOT EXISTS idx_ci_sessions_timestamp ON ci_sessions(timestamp);

-- Indexes for performance
CREATE INDEX IF NOT EXISTS idx_dives_user_id ON dives(user_id);
CREATE INDEX IF NOT EXISTS idx_dives_site_id ON dives(dive_site_id);
CREATE INDEX IF NOT EXISTS idx_dives_date ON dives(dive_date);
CREATE INDEX IF NOT EXISTS idx_ratings_rated_user ON ratings(rated_user_id);
CREATE INDEX IF NOT EXISTS idx_ratings_dive ON ratings(dive_id);
CREATE INDEX IF NOT EXISTS idx_dive_participants_dive ON dive_participants(dive_id);
CREATE INDEX IF NOT EXISTS idx_dive_participants_user ON dive_participants(user_id);
