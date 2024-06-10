package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.rooms.get_by_id;

import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequiredArgsConstructor
@RequestMapping(path = "rooms")
public class GetRoomByIdController {
    private final GetRoomByIdService getRoomByIdService;

    @GetMapping(path = "{id}")
    public ResponseEntity<GetRoomByIdResponse> getRoomById(Long id) {
        return this.getRoomByIdService.getById(id);
    }
}
