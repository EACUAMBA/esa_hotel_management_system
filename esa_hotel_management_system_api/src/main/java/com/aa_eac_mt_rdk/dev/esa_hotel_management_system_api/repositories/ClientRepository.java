package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.ClientEntity;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface ClientRepository extends JpaRepository<ClientEntity, Long> {
}
