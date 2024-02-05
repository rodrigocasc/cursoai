import { z } from "zod";

export class CourseValidator {

    static schema = z.object({
        name: 
            z.string({required_error: "Necessário preencher o campo"})
            .min(10, "Nome deve conter mais de 10 caracteres")
            .max(50, "Nome ultrapassou o limite de 50 caracteres"),
    
        description: 
            z.string({required_error: "Necessário preencher o campo"})
            .min(50, "Descrição deve conter mais de 50 caracteres")
            .max(763, "Descrição ultrapassou o limite de 763 caracteres"),
    })
}