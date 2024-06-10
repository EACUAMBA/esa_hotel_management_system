package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities;

import jakarta.persistence.*;
import lombok.*;
import lombok.experimental.SuperBuilder;

import java.util.Date;

@Getter
@Setter
@AllArgsConstructor
@NoArgsConstructor
@SuperBuilder(toBuilder = true)
@Entity
@Table(name = "t_relatorio")
public class RelatorioEntity extends AbstractEntity {
    private String tipoRelatorio;
    
    @Temporal(TemporalType.DATE)
    private Date dataGerado;
    
    private String conteudo;
}
