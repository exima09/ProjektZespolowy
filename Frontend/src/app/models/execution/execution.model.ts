import { Prisoner } from "../prisoner/prisoner.model";

export class Execution {
    id?: number;
    worker;
    prisoner: Prisoner;
    executionDate: string;
    lastWish: string;
}
