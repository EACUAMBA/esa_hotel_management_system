package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.configurations;

import lombok.RequiredArgsConstructor;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.context.annotation.Primary;
import org.springframework.core.env.Environment;
import org.springframework.jdbc.datasource.DriverManagerDataSource;

import javax.sql.DataSource;

@Configuration
@RequiredArgsConstructor
public class SQLiteConfiguration {
    private final Environment environment;

    @Bean
    @Primary
    public DataSource dataSource() {
        final DriverManagerDataSource dataSource = new DriverManagerDataSource();
        dataSource.setDriverClassName(this.environment.getRequiredProperty("driverClassName"));
        dataSource.setUrl(environment.getRequiredProperty("sqlite.datasource.url"));
        return dataSource;
    }
}
