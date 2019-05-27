import { Prisoner } from "../prisoner/prisoner.model";

export class Visit {
    id?: number;
    prisoner: Prisoner;
    dateStart: string;
    dateStop: string;
    statusAccepted: boolean;
    bookingPerson: string;
    conctactType: string;
    contact: string;
}
