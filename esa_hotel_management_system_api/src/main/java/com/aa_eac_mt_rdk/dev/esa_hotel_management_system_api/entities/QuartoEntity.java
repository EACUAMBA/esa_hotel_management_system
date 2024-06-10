package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities;

import jakarta.persistence.*;
import lombok.*;
import lombok.experimental.SuperBuilder;

@Getter
@Setter
@AllArgsConstructor
@NoArgsConstructor
@SuperBuilder(toBuilder = true)
@Entity
@Table(name = "t_quarto")
public class QuartoEntity extends AbstractEntity {
    private String numero;
    private String tipo;
    private String status;
    private Double precoPorNoite;
}
