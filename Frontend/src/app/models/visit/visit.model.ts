import { Prisoner } from "../prisoner/prisoner.model";

export class Visit {
    id?: number;
    prisoner: Prisoner;
    dateStart: Date;
    dateStop: Date;
    statusAccepted: boolean;
    bookingPerson: string;
    conctactType: string;
    contact: string;
}