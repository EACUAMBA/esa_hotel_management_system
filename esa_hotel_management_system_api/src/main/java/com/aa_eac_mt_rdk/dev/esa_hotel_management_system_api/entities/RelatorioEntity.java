package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities;

import jakarta.persistence.*;
import lombok.*;
import lombok.experimental.SuperBuilder;

import java.time.LocalDateTime;

@Getter
@Setter
@AllArgsConstructor
@NoArgsConstructor
@SuperBuilder(toBuilder = true)
@Entity
@Table(name = "t_relatorio")
public class RelatorioEntity extends AbstractEntity {
    private String tipoRelatorio;
    
    private LocalDateTime dataGerado;
    
    private String conteudo;
}
